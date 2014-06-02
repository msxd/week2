-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 08 2014 г., 17:34
-- Версия сервера: 5.5.37-0ubuntu0.13.10.1
-- Версия PHP: 5.5.3-1ubuntu2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `week3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `path` varchar(255) NOT NULL DEFAULT '000',
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_parent_id` (`parent_id`),
  KEY `fk_comments_post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `body`, `email`, `created_at`, `updated_at`, `parent_id`, `path`, `post_id`) VALUES
(3, '-', '123', '2014-05-08 10:03:00', NULL, NULL, '001', 12),
(4, '-', 'my@my.ri', '2014-05-08 10:04:00', NULL, NULL, '002', 12),
(5, '--', 'not@mail', '2014-05-08 10:05:00', NULL, 3, '001.001', 12),
(6, '--', 'asaer', '2014-05-08 10:07:00', NULL, 3, '001.002', 12),
(7, '---', 'zcxq', '2014-05-08 10:06:00', NULL, 5, '001.001.001', 12),
(8, '--', '', '2014-05-08 10:08:00', NULL, 3, '001.003', 12),
(9, '123456', '123456', '2014-05-08 14:27:32', NULL, NULL, '000', 12),
(10, '123456', '123456', '2014-05-08 14:27:32', NULL, NULL, '000', 12),
(11, '123456', '123456', '2014-05-08 14:27:32', NULL, NULL, '000', 12),
(12, 'asdasd', 'adssaddsa', '2014-05-08 14:27:51', NULL, NULL, '000', 12),
(13, 'qwerty', 'adssaddsa', '2014-05-08 14:29:12', NULL, 5, '001.001.002', 12);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `published` int(11) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_post_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `body`, `title`, `created_at`, `updated_at`, `user_id`, `published`, `img_path`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam commodo tristique. Curabitur sollicitudin, justo ac tincidunt pulvinar, velit arcu vestibulum odio, dapibus dignissim sapien odio nec tortor. Mauris ac mauris nec tellus dignissim luctus ut a massa. Nulla gravida tortor purus, ac fermentum lacus lobortis ac. Donec vel ipsum faucibus magna ultricies suscipit. Quisque rutrum hendrerit arcu quis facilisis. Ut dui neque, elementum et nulla in, sollicitudin pretium risus. Etiam eget felis pellentesque, hendrerit lacus a, porttitor turpis. Ut faucibus lectus ac aliquam convallis. Nulla facilisi. Fusce lacus lorem, ultricies non enim ac, hendrerit convallis lectus. Vivamus eget orci fermentum, ultricies turpis quis, auctor ipsum.\n\nNam volutpat id erat ac euismod. Aenean placerat ac sapien quis tristique. Vestibulum quis erat at enim pellentesque porttitor non ac neque. Pellentesque nec rhoncus nibh. Aenean suscipit enim posuere sollicitudin rhoncus. Fusce tortor tortor, adipiscing eu quam sit amet, iaculis vulputate dui. Curabitur molestie diam mi, quis luctus urna cursus porttitor. Curabitur vel augue risus. Integer quis velit sodales, mollis metus vel, viverra justo.\n\nNulla consequat est sed leo porta consectetur. Maecenas lobortis elit dolor, in ultricies arcu laoreet eu. Sed mollis eleifend lacus, id consectetur quam facilisis eget. Cras ornare sit amet risus quis eleifend. Nam eget velit quis felis ultrices adipiscing. Aenean sollicitudin vestibulum metus sit amet commodo. Etiam luctus, nibh ut imperdiet venenatis, nisi sem ullamcorper elit, ac sagittis odio mi sit amet lectus. Duis feugiat hendrerit dictum. Aenean commodo orci ultricies placerat aliquam. Integer porta, eros nec porta tempus, mauris lectus suscipit dolor, nec adipiscing quam arcu eu lectus. Duis massa est, mattis nec tincidunt ut, suscipit tincidunt quam. Integer fringilla pharetra velit, vel congue odio tincidunt at. Nulla quis libero volutpat, fermentum diam in, iaculis ligula.', 'it is first news', '2014-04-23 02:03:09', '2014-05-05 11:55:24', 1, 1, ''),
(2, 'Fusce id elit tristique, facilisis tellus at, varius erat. Proin vehicula non quam non lacinia. Vestibulum ornare massa in justo vulputate, eget egestas eros faucibus. Morbi eget eros est. Ut consectetur lacinia lorem vel aliquet. Nulla eleifend eros lorem, faucibus dapibus nibh semper sit amet. Morbi et odio ut erat fringilla dapibus.\n\nNam eget lobortis massa, at tempor lacus. Duis vitae ligula odio. Curabitur diam elit, condimentum vitae ligula id, tempus laoreet augue. Donec rhoncus scelerisque turpis in eleifend. Suspendisse euismod nibh eu justo dapibus, vitae accumsan felis luctus. Aenean aliquet elit quis elit placerat, a laoreet urna commodo. In rhoncus luctus mi, ac auctor sem facilisis vitae. Cras quis tortor vitae arcu tincidunt elementum at at diam. Aenean eu massa a dui viverra lobortis. Maecenas in mauris eros. Etiam neque arcu, fringilla non nisi non, sollicitudin porta arcu. Praesent nec turpis elementum, venenatis dui nec, pretium nibh. Nullam elit quam, interdum vel rutrum in, volutpat nec nisl. Ut mattis pharetra augue.\n\nCurabitur pellentesque mi vel sollicitudin mollis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus fermentum lobortis erat nec luctus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas ac iaculis urna, ac venenatis lorem. Etiam in pellentesque dolor. Ut quam nunc, pulvinar nec sem id, tristique tempus mauris. Suspendisse mollis, lectus a faucibus interdum, quam odio faucibus dolor, sit amet tempus mauris elit ut leo. Praesent tincidunt consequat convallis. Vivamus rhoncus metus quis est imperdiet, nec aliquam mi condimentum.', 'News #2', '2014-04-23 04:09:12', '0000-00-00 00:00:00', 1, 1, ''),
(3, 'Integer fringilla, ligula vel aliquam egestas, nulla tortor luctus mauris, a mattis nisi diam eu felis. Aliquam tristique libero nec ultricies iaculis. Maecenas enim urna, fringilla et semper id, malesuada et nisi. Morbi velit nisi, faucibus sed enim pharetra, gravida sodales nunc. Mauris vel enim euismod, porttitor justo at, pretium purus. Sed a justo interdum, molestie ipsum vitae, auctor ipsum. Ut sodales vestibulum ligula eget sollicitudin. Morbi et metus at tortor pulvinar aliquet. Maecenas nec ultricies eros, euismod sodales dolor. Mauris dolor ante, gravida ac risus non, vestibulum dapibus nibh. Aenean quis nunc pharetra, lobortis lectus a, ultricies mi. Aenean vitae dolor eu neque ornare feugiat id nec diam. Cras sollicitudin cursus mauris eu sollicitudin.\n\nUt ut bibendum tortor, ut aliquet est. Suspendisse eget mauris et purus cursus commodo sit amet ac turpis. Nullam sed quam hendrerit enim elementum pretium ut et ipsum. Sed tortor quam, congue a condimentum et, dapibus ac ligula. Praesent erat nulla, posuere quis nisl eu, facilisis commodo lectus. Curabitur pharetra ante at ante vehicula imperdiet. Cras risus urna, laoreet quis odio nec, luctus pharetra mi. Suspendisse imperdiet aliquet felis. Nunc interdum odio vitae sem pretium accumsan.\n\nNulla dictum orci ac ultrices tincidunt. In porta, ipsum sit amet dictum imperdiet, dui ipsum facilisis urna, vel mattis metus nibh quis nunc. Sed nibh diam, iaculis at dictum ut, mollis sed quam. Praesent mattis, orci ac pretium lobortis, risus turpis malesuada turpis, faucibus commodo orci arcu nec orci. Quisque eu faucibus massa, at ultricies neque. Nulla eu odio enim. Maecenas sollicitudin lorem arcu, id dapibus nisl faucibus nec. Mauris mattis dolor vel mauris convallis, vitae ornare turpis mattis. Maecenas iaculis vel quam at rutrum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse iaculis diam in volutpat gravida. Proin elit nulla, pellentesque sed mattis id, eleifend vitae nisi. Donec sed luctus ante, non porttitor augue. Nam tristique sollicitudin ornare. Sed egestas aliquet nibh sit amet placerat.', 'Hot news', '2014-04-23 04:09:15', '2014-04-28 08:10:04', 1, 0, ''),
(4, 'Quisque adipiscing enim accumsan massa elementum, id tempus justo rhoncus. Vestibulum rutrum nunc ut interdum ornare. Donec vitae ultricies orci, ac pretium quam. Sed vitae dictum dui. Cras eget faucibus massa, vitae viverra ante. Proin vitae adipiscing diam. Praesent erat ante, suscipit facilisis pharetra vitae, tincidunt eu dolor. Mauris nec ullamcorper libero. Aenean pulvinar turpis vulputate ipsum tristique rutrum. Cras porta urna id elit bibendum, nec sagittis enim bibendum. Sed ut lectus a dui tempor pulvinar. Curabitur mattis ligula in pretium facilisis. Sed elementum justo lectus, eget ornare justo scelerisque a. Morbi ultricies ornare fringilla. Vestibulum feugiat velit vitae neque luctus, eget gravida nisi elementum.\n\nCras molestie augue ligula, id lacinia velit elementum sit amet. Phasellus mollis tristique neque, vitae interdum lectus accumsan pretium. Pellentesque at dictum eros. In condimentum, enim ac bibendum faucibus, sapien eros lacinia libero, ut dignissim lacus dolor a libero. Sed vestibulum ligula et tortor cursus, vel posuere sem vehicula. Mauris tincidunt, leo eget malesuada consequat, augue velit pellentesque sapien, vitae consectetur odio metus non odio. Aliquam consectetur, tellus vitae pellentesque porttitor, lorem ante pharetra lectus, eu pellentesque nisi libero sit amet arcu. Phasellus sit amet mi consectetur, laoreet ipsum vitae, tempus sapien. Pellentesque suscipit nisl massa, eu ornare lorem hendrerit ut. In imperdiet egestas euismod. Maecenas sit amet gravida leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras metus libero, sodales adipiscing mauris eu, auctor feugiat arcu.\n\nEtiam pretium malesuada quam eget fermentum. Aenean tortor neque, cursus ac purus a, tristique vulputate neque. Nullam at arcu non nibh mollis scelerisque. Nullam tincidunt magna interdum eros hendrerit pretium. Nulla fringilla vestibulum mi ac posuere. Sed viverra, libero eget egestas suscipit, dolor magna congue nunc, sit amet tincidunt mi erat in massa. Suspendisse potenti. Aliquam faucibus mauris purus, sodales tincidunt elit mollis nec. Aenean vehicula metus eu ullamcorper convallis. Suspendisse venenatis cursus leo, eget faucibus lorem iaculis et. Vestibulum in sem sit amet orci accumsan tincidunt. Fusce pellentesque scelerisque mauris, id egestas lacus cursus sed. Fusce dignissim sapien nec fermentum ultricies. Quisque varius non libero eget condimentum. Cras dapibus felis pharetra blandit dignissim. Fusce congue purus sem, non blandit nisl commodo non.', 'Third news', '2014-04-23 04:19:12', '0000-00-00 00:00:00', 1, 1, ''),
(5, 'Curabitur ac mi vestibulum, convallis elit vitae, interdum urna. Sed venenatis augue dui, ut gravida leo adipiscing eget. Morbi non tellus a leo imperdiet laoreet in ac nunc. Vestibulum ipsum augue, vulputate vel fermentum id, pellentesque quis quam. Fusce facilisis ipsum eget nisi laoreet bibendum vel vitae augue. Vivamus elementum nisl quis pretium vehicula. Aenean et nisi non lectus hendrerit hendrerit sed quis diam. Aenean ut arcu ante. Duis luctus, arcu sit amet aliquam convallis, enim lectus pretium orci, ac aliquet velit velit sit amet eros. Nulla tempor elit at justo rutrum iaculis mollis id diam. Phasellus ut dui et nisi vehicula auctor ut ut est.\n\nMaecenas luctus risus id justo cursus suscipit. Pellentesque vitae dapibus ante. Mauris ac ullamcorper dui. Integer consectetur scelerisque tempus. Praesent ac fringilla lorem, non posuere massa. Donec ut nisl eu nisi suscipit rutrum. Sed ac luctus neque. Maecenas malesuada posuere adipiscing. Fusce eget felis in eros lacinia molestie ut ut felis. Maecenas id risus hendrerit, pellentesque purus gravida, laoreet lorem. Vivamus condimentum interdum imperdiet.\n\nVivamus vehicula porttitor libero, a fringilla augue malesuada quis. Pellentesque faucibus ac metus eleifend consequat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut vitae urna vel lacus facilisis accumsan porttitor id turpis. Integer turpis orci, tristique in pulvinar sit amet, accumsan id mauris. Nullam vehicula ullamcorper quam at bibendum. Donec lobortis lorem odio, at venenatis justo lacinia dictum.', 'adsdadsa', '2014-04-23 04:19:15', '2014-05-05 11:46:06', 1, 0, ''),
(6, 'Ut pellentesque blandit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean vestibulum at dolor nec cursus. Etiam elementum felis ac mauris malesuada egestas. Mauris sit amet lorem sed massa porta elementum vitae ut enim. Sed et aliquam enim, in sollicitudin metus. Nulla aliquet aliquam libero vitae fringilla. Nulla vestibulum nunc eget eleifend malesuada. Cras eu sapien convallis, consectetur turpis sit amet, venenatis justo.\n\nPhasellus imperdiet porttitor nisl quis blandit. Proin scelerisque semper urna in congue. Etiam tempus purus nec congue mattis. Curabitur nisi ligula, ullamcorper suscipit diam et, dapibus porttitor lacus. Pellentesque porta porttitor eros, sed sollicitudin velit vehicula nec. Vivamus hendrerit est sed quam malesuada, nec suscipit eros pharetra. Fusce vitae ligula quis dui bibendum aliquam. Aliquam laoreet vulputate purus suscipit dictum. Donec vehicula congue elit in lacinia. Vivamus fermentum risus sed lacus interdum viverra. Donec varius eleifend felis, eget accumsan ipsum aliquet sit amet.\n\nCurabitur a augue porta, lacinia urna eget, consequat velit. Etiam tempus non odio ac faucibus. Praesent sit amet lectus condimentum, laoreet turpis at, sodales erat. Vestibulum dolor sapien, bibendum et augue ac, sagittis blandit leo. Proin nec auctor sapien, eu blandit sem. Aenean eget ipsum eros. Nulla vitae aliquet leo. Pellentesque a nisi urna. Proin sit amet enim quis odio convallis interdum ac et nulla. Curabitur in sapien ut metus porta facilisis. Nullam sit amet varius sapien. Aliquam erat volutpat. Vivamus ipsum sapien, adipiscing vel augue non, tincidunt gravida enim. In id iaculis risus. Donec sit amet aliquet sapien.', 'try to edit post', '2014-04-23 04:20:12', '2014-05-06 08:08:15', 1, 0, ''),
(7, 'Donec at magna tempus, placerat nisl tempor, suscipit enim. Integer a aliquet augue, id semper arcu. Phasellus sed metus vehicula, luctus nisi nec, semper purus. Sed varius hendrerit varius. Praesent mollis orci lectus, sed mollis ante volutpat imperdiet. Aenean gravida nunc et felis cursus ultricies. Etiam eu mattis purus, vitae suscipit nunc. Aenean et ultricies elit. Duis ac porta enim. Fusce lobortis nisl in mauris porttitor suscipit. Suspendisse feugiat libero sit amet venenatis luctus. Phasellus luctus odio nulla, a bibendum ante molestie vitae. Pellentesque feugiat adipiscing enim, vel semper risus sodales et. Maecenas at mauris velit. Integer a neque sit amet massa euismod condimentum sit amet vel lorem. Nulla pellentesque, tellus at interdum sollicitudin, quam sapien semper enim, ac interdum metus quam quis velit.\n\nAenean consequat non justo id pharetra. Quisque vestibulum eu orci in mollis. Mauris tincidunt blandit rhoncus. Proin a odio non nisl malesuada convallis nec ut arcu. Ut convallis auctor placerat. Maecenas turpis lectus, blandit at adipiscing in, rhoncus eu massa. Aliquam eleifend leo eget quam aliquet ornare. Curabitur vitae nunc vel nisi volutpat consequat. Mauris malesuada eget purus sit amet iaculis. Suspendisse luctus neque eu elit porta, a posuere nibh lacinia. Phasellus justo erat, gravida id commodo vitae, aliquet sit amet est.\n\nNulla non justo quis velit volutpat tempus vitae non nisl. Nulla a turpis libero. Curabitur mattis venenatis faucibus. Praesent ut massa sed odio fringilla bibendum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed sapien lacus, convallis in gravida at, hendrerit a lorem. Curabitur ut eros ac neque imperdiet gravida et ac neque. Curabitur dignissim diam vel risus tincidunt feugiat. Etiam erat urna, tempus nec tincidunt ut, placerat ut est. Cras consequat felis a ullamcorper posuere. Curabitur egestas felis nisi, at egestas lectus faucibus a. Praesent non justo at elit convallis vulputate.', '!xzc21231321zcx', '2014-05-06 08:30:25', NULL, 1, 1, ''),
(8, 'Nunc sodales libero ut ornare adipiscing. Pellentesque elementum sagittis vulputate. Maecenas dapibus tellus eget metus cursus sagittis. Vestibulum leo dui, hendrerit at mi egestas, porttitor dictum turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi odio arcu, ullamcorper ut risus ut, sodales sodales lorem. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer condimentum hendrerit leo quis sagittis. Sed blandit porta odio. Fusce massa elit, eleifend a scelerisque ac, condimentum vitae risus. Curabitur dapibus condimentum tellus non aliquam. Donec ut imperdiet turpis, et ultrices turpis. Sed vel tellus at velit lobortis rutrum. Morbi feugiat est non arcu rhoncus ornare. Sed sagittis mi in lacus mollis, ut auctor turpis ullamcorper.\n\nNullam ut eros sit amet nunc condimentum rutrum. Sed pulvinar dolor sapien, a convallis purus fermentum sed. Integer eleifend mollis libero, eu adipiscing ipsum dignissim et. Morbi blandit, turpis tincidunt tincidunt faucibus, ipsum justo fringilla urna, et porttitor risus ante ut lacus. Sed imperdiet commodo magna, ac imperdiet diam condimentum ut. Integer ultrices nisl sed tortor condimentum, vitae molestie magna lobortis. Praesent non massa sit amet enim fermentum consequat condimentum et arcu. Maecenas blandit neque vitae nisl egestas, ut rhoncus neque eleifend. Sed vel congue felis. Nulla dui justo, posuere sit amet vehicula eget, convallis vel libero. Integer arcu ante, suscipit vel ante eu, sagittis suscipit lorem. Cras rhoncus porttitor nisl, a malesuada eros convallis quis. Proin vitae sem et quam iaculis venenatis. Nunc condimentum malesuada odio at venenatis. Vestibulum vestibulum vitae elit nec dapibus. Morbi at tortor mollis erat convallis fermentum quis a nisl.\n\nMaecenas dignissim massa sed ullamcorper venenatis. Cras a lectus convallis, dignissim ipsum et, tincidunt odio. Cras in mauris a orci congue dapibus. Mauris viverra venenatis consequat. Aenean tincidunt, odio at ornare pulvinar, nulla dui egestas urna, vel ultricies odio nisl eget felis. Nunc aliquet tellus nunc, et pharetra augue scelerisque sed. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus a congue diam, eget tincidunt magna. Fusce fermentum magna arcu, dictum euismod lorem interdum non. Integer quis fringilla elit. Proin porttitor, dui sed hendrerit consectetur, velit sapien condimentum ligula, vitae euismod magna neque nec orci. Duis nulla lectus, mollis eget diam ut, fringilla mollis neque. Integer pulvinar malesuada urna, quis molestie mi porta eu.', '!xzc21231321zcx', '2014-05-06 08:31:06', NULL, 1, 1, ''),
(9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod, leo eget gravida tempor, sem tortor tempus purus, non semper purus arcu eu diam. Praesent quis nulla viverra, dignissim mauris nec, consequat enim. Maecenas lobortis condimentum quam, nec luctus velit tempor sit amet. Morbi ullamcorper, enim ac congue tempus, erat mi tristique erat, laoreet sollicitudin mi ante et dolor. Ut nec erat facilisis, consectetur nunc nec, condimentum dui. Pellentesque luctus nunc posuere felis ullamcorper auctor. Praesent non tincidunt tortor, vel vestibulum nulla.\n\nCras leo ligula, ultrices ac ultrices non, vestibulum sit amet erat. Donec mollis leo turpis, quis interdum urna tempor eget. Integer malesuada elit nec congue convallis. Vestibulum posuere vulputate mauris a pellentesque. Curabitur ornare ultricies ligula laoreet consequat. Fusce mollis sodales scelerisque. Vestibulum non dui in augue auctor faucibus. Nunc sollicitudin nisi velit. Nullam sapien nisi, vestibulum consectetur arcu a, porta placerat sem. Nam quis eleifend magna, at fermentum nulla. Ut tincidunt lacinia mi sit amet ultrices. Sed aliquet eu arcu eu vestibulum. Nulla gravida feugiat est non ullamcorper. Nunc eleifend suscipit egestas.\n\nDuis a ultricies massa. Integer sed nisl sed nibh suscipit pellentesque ac ac massa. Nam ac tempus nunc. Aliquam erat volutpat. In tempus mi quis diam pretium, id facilisis purus lacinia. Nulla facilisi. In laoreet velit eu lorem mattis rutrum.', 'zcxzcxzxczxczxc', '2014-05-06 08:31:30', NULL, 1, 1, ''),
(10, '<p>Nulla facilisi. Sed lacinia, mi in luctus luctus, felis mauris mollis enim, id fermentum mi tellus luctus diam. Integer condimentum cursus fermentum. Duis vitae nisl at velit aliquet rutrum ut interdum massa. Donec nec justo imperdiet sem suscipit tincidunt in et tortor. Suspendisse suscipit condimentum nulla sit amet suscipit. Vivamus bibendum libero nec consequat vehicula. Sed blandit lectus velit, laoreet posuere mi interdum rhoncus. Suspendisse potenti. Vestibulum mollis porttitor consequat. Aliquam congue ut arcu in porta. Duis consequat, justo nec elementum sollicitudin, lorem lacus accumsan enim, eu tincidunt orci ipsum ut nibh. Mauris eget arcu vehicula, hendrerit diam non, vestibulum elit. Aenean auctor eget leo non rhoncus. Integer mollis elementum nulla, faucibus ultricies lorem ullamcorper id. In suscipit sit amet metus eget mollis. Praesent ligula lectus, sodales sit amet augue et, aliquam ultrices magna. Nam vel facilisis risus. Ut pretium nunc vel nunc luctus, non feugiat libero faucibus. In eget lorem a ligula eleifend pretium. Suspendisse fermentum laoreet ipsum a auctor. Quisque in augue dolor. Nulla velit ligula, ultricies vitae dolor non, placerat euismod lacus. Vestibulum ac ultricies lorem. Etiam leo velit, scelerisque a libero ac, laoreet euismod dui. Sed dictum, lorem tempor lacinia dapibus, libero leo iaculis neque, et tincidunt metus augue in libero. Sed ac condimentum quam. Sed lobortis eu mauris non vulputate. Quisque purus magna, commodo quis faucibus eget, tempor ut sapien. Fusce rutrum volutpat aliquet. Aenean posuere purus sit amet quam lacinia pulvinar. Maecenas tincidunt et dolor id tempor.</p>\r\n', 'News 12', '2014-05-06 08:31:46', '2014-05-08 03:37:40', 3, 1, ''),
(11, 'In hendrerit felis id dui lacinia, sed ornare orci malesuada. Pellentesque at congue neque. Mauris posuere quam congue sem lobortis luctus. Quisque rutrum sollicitudin massa, vitae lobortis massa aliquet at. In purus justo, luctus venenatis interdum at, imperdiet sed est. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean venenatis metus quis fermentum pulvinar. Nullam id metus non lacus lobortis porttitor. Aenean semper vitae ligula ac feugiat.\n\nSed pharetra id turpis ut lacinia. Quisque ac mauris eget elit placerat tristique. Quisque at accumsan mi. Sed arcu leo, accumsan at libero vitae, rhoncus viverra erat. Duis elit metus, eleifend eget lobortis et, vestibulum in lacus. Praesent placerat molestie auctor. Integer pharetra turpis non pharetra posuere. Sed tristique, nibh quis feugiat malesuada, felis justo sodales est, et mattis orci purus a magna. Suspendisse nec libero id enim ultricies adipiscing a laoreet nulla. Quisque aliquam tincidunt porta.\n\nMorbi in sem nec est ornare commodo in eu tortor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce blandit lorem at varius posuere. Integer egestas porttitor velit, id pharetra dui pharetra vel. Nulla egestas tempor erat, ut volutpat odio gravida in. Curabitur a arcu ac massa elementum volutpat at quis eros. Duis accumsan magna vel elit ornare, vel ultrices eros posuere. Sed et sapien sit amet nunc feugiat hendrerit. Integer in lacinia sem, vel ultricies nibh. Vivamus iaculis augue vel porttitor vulputate. Aliquam eleifend, velit id facilisis imperdiet, orci sapien lobortis risus, eget ornare ante neque eget neque. Praesent mollis augue lacus. Integer at pulvinar lectus. Nulla cursus ipsum diam, vitae malesuada tellus ultricies vitae.', 'dsadasdsadadasd', '2014-05-06 08:33:02', NULL, 3, 1, ''),
(12, '<h2 style="font-style:italic;"><span class="marker">Vivamus</span> placerat</h2>\r\n\r\n<p>turpis et malesuada imperdiet. Quisque mattis viverra elit, nec tincidunt massa facilisis quis. Aenean mattis augue risus, ac rutrum sem pharetra at. In sed bibendum nunc, in iaculis mauris. Pellentesque sit amet elit lacinia, placerat massa non, scelerisque nulla. Ut vestibulum tellus quis dictum fermentum. Nunc tempor neque massa, nec consectetur sapien tincidunt mattis. Donec ultrices odio ut nibh vestibulum, sed porta metus cursus. Nunc id consequat nulla. Suspendisse consequat diam vel elit molestie imperdiet. Sed hendrerit libero quis augue tempus pharetra. Sed non volutpat orci. Cras rhoncus egestas sollicitudin. Sed commodo aliquet sapien. Quisque auctor tempus erat at porttitor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce condimentum vitae justo sed molestie. Aliquam nisl nisl, vulputate vel sem vel, posuere malesuada nibh. Nulla sit amet nunc et arcu fermentum cursus. Quisque non ullamcorper orci. Nulla vel nunc dictum, pretium nibh volutpat, adipiscing magna. Integer ac condimentum magna. Curabitur dictum mauris ac vulputate semper. Sed quis urna fringilla, vehicula nulla eget, tincidunt mi. Vivamus fringilla turpis quis est euismod, at venenatis odio viverra. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean ac quam a tortor faucibus sollicitudin in sed risus. Ut ac mauris et felis commodo posuere. Sed convallis sapien vitae quam aliquet blandit. Pellentesque sit amet tincidunt enim. Nunc porttitor placerat viverra.</p>\r\n', 'asdasdxzc235r4', '2014-05-06 08:33:47', '2014-05-08 11:46:37', 3, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=greek;

--
-- Дамп данных таблицы `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1399537841),
('m140425_073636_users', 1399537843),
('m140425_073645_posts', 1399537843),
('m140425_073651_comments', 1399537844);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook_id` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role_id` tinyint(4) DEFAULT '0',
  `deleted` tinyint(4) DEFAULT '0',
  `approved` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `facebook_id`, `email`, `hashed_password`, `phone`, `first_name`, `last_name`, `role_id`, `deleted`, `approved`) VALUES
(1, '123', 'adm', '202cb962ac59075b964b07152d234b70', '', 'Admin', 'role_adm', 2, 0, 1),
(2, '', 'mod', '202cb962ac59075b964b07152d234b70', '', 'Moder', 'role_mod', 1, 0, 1),
(3, '', 'usr', '202cb962ac59075b964b07152d234b70', '', 'User_NAME', 'role_usr_TEST', 0, 0, 1),
(4, '123', 'valikov.ids@gmail.com', '202cb962ac59075b964b07152d234b70', 'my mobile phone', 'Alex', 'Valikov', 2, 0, 1);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_post_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
