<?php

class HierarchyBehavior extends CActiveRecordBehavior
{
	public $pathAttribute = 'path';
	public $parentAttribute = 'parent_id';
	public $parentRelation = 'parent';
	private $_oldParentId = null;

	/**
	 * Количество символов отведенных для индексов в пути для дерева
	 *
	 * Например:
	 *        3 => 001.002.003.004 (ограничение 999 элементов для каждого уровня)
	 *        4 => 0001.0002.0003.0004 (ограничение 9999 элементов для каждого уровня)
	 */
	public $pathIndexSize = 3;


	//***************************************************************************
	// События
	//***************************************************************************


	public function beforeSave($event)
	{
		if ($this->_oldParentId == $this->owner->{$this->parentAttribute} && $this->owner->{$this->parentAttribute}) return;

		$model = $this->owner;
		$path = $this->pathAttribute;
		$parent_id = $this->parentAttribute;
		$parent = $this->parentRelation;
		$pathIndexSize = $this->pathIndexSize;

		if (empty($model->{$parent_id})) $model->{$parent_id} = null;

		$last = $model->findByAttributes(
			array($parent_id => $model->{$parent_id}),
			array('order' => "CONCAT({$path}, '0') DESC", 'limit' => 1)
		);


		if ($last && preg_match('/(\d+)$/', $last->{$path}, $matches))
			$model->{$path} = preg_replace('/\d+$/', str_pad($matches[1] + 1, $pathIndexSize, 0, STR_PAD_LEFT), $last->{$path});
		else
			$model->{$path} = ($model->{$parent_id} ? $model->{$parent}->{$path} . '.' : '') . str_pad(1, $pathIndexSize, 0, STR_PAD_LEFT);
	}

	public function afterFind($event)
	{
		$this->_oldParentId = $this->owner->{$this->parentAttribute};
	}


	//***************************************************************************
	// Функции модели
	//***************************************************************************


	public function orderHierarchy($order = 'DESC')
	{
		$this->owner->getDbCriteria()->mergeWith(array(
			'order' => 'CONCAT(' . $this->owner->getTableAlias(false, false) . '.path, "0") ' . $order, // Важно!!! необходимо для правильной сортировки
		));
		return $this->owner;
	}

	public function rebuildPaths()
	{
		$model = $this->owner;
		$path = $this->pathAttribute;
		$parent_id = $this->parentAttribute;
		$parent = $this->parentRelation;
		$pathIndexSize = $this->pathIndexSize;

		$childs = 0;

		// запрашиваем все записи
		$tmpModels = $model->resetScope()->findAll();

		//dbug::stopArray($tmpModels);

		foreach ($tmpModels as $tmpModel) {
			$id = $tmpModel['id'];
			$pid = $tmpModel[$parent_id];

			if ($pid) {
				if (empty($paths[$pid])) {
					$paths[$pid] = array(
						'childs' => 0,
						'path' => ''
					);
				}

				$paths[$pid]['childs']++;
				$paths[$id]['childs'] = 0;
				$paths[$id]['path'] = $paths[$pid]['path'] . '.' . str_pad($paths[$pid]['childs'], $pathIndexSize, 0, STR_PAD_LEFT);
				$paths[$id]['parent'] = $pid;
			} else {
				$paths[$id]['childs'] = 0;
				$childs++;
				$paths[$id]['path'] = str_pad($childs, $pathIndexSize, 0, STR_PAD_LEFT);
			}

			// обновление
			Yii::app()->db->createCommand()->update($model->tableName(), array(
				$path => $paths[$id]['path'],
			), 'id = :id', array(':id' => $id));
		}
	}

	public function getLevel()
	{
		return substr_count($this->owner->path, '.');
	}


}
