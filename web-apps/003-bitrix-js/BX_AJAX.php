<?
// Домашнее задание по теме "Библиотека Bitrix JS"
// https://github.com/netology-code/bweb-homeworks/blob/main/3.%20BITRIX%20JS/
// В материалах к заданию есть файл BX_AJAX.php.
// Добавьте в код комментарии, чтобы стало понятно, какие действия выполняются.

// Подключаем пролог ядра Bitrix
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
// Устанавливаем заголовок страницы
$APPLICATION->SetTitle("AJAX");
// Подключаем библиотеку для AJAX
CJSCore::Init(array('ajax'));
// Значение будет использоваться при AJAX-запросе в качестве значения GET-параметра ajax_form
$sidAjax = 'testAjax';

// Обработка AJAX-запроса
if(isset($_REQUEST['ajax_form']) && $_REQUEST['ajax_form'] == $sidAjax){
   $GLOBALS['APPLICATION']->RestartBuffer();

   // Возвращаем JSON с результатом
   echo CUtil::PhpToJSObject(array(
            'RESULT' => 'HELLO',
            'ERROR' => ''
   ));
   die();
}

?>
<div class="group">
   <!-- В элемент с id block будет вставлен результат запроса -->
   <div id="block"></div >
   <!-- В элемент с id process отображается просьба подождать -->
   <div id="process">wait ... </div >
</div>
<script>
// Включить отладку
window.BXDEBUG = true;

// Функция запускает AJAX-запрос
function DEMOLoad(){
   // Скрываем элемент для вывода результата
   BX.hide(BX("block"));
   // Показываем элемент с просьбой подождать
   BX.show(BX("process"));
   // Отправляем запрос на текущую страницу с добавлением GET-параметра ajax_form
   BX.ajax.loadJSON(
      '<?=$APPLICATION->GetCurPage()?>?ajax_form=<?=$sidAjax?>',
      DEMOResponse
   );
}

// Функция обрабатывает ответ
function DEMOResponse (data){
   // Логируем ответ в консоль
   BX.debug('AJAX-DEMOResponse ', data);
   // Вставляем результат в элемент с id block
   BX("block").innerHTML = data.RESULT;
   // Показываем блок с результатом
   BX.show(BX("block"));
   // Скрываем сообщение подождать
   BX.hide(BX("process"));

   // Вызваем событие DEMOUpdate (сейчас оно закомментированно)
   BX.onCustomEvent(
      BX(BX("block")),
      'DEMOUpdate'
   );
}

// Выполняется после полной загрузки DOM
BX.ready(function(){
   // Закомментированное событие DEMOUpdate перезагружает страницу
   /*
   BX.addCustomEvent(BX("block"), 'DEMOUpdate', function(){
      window.location.href = window.location.href;
   });
   */
   // Скрываем блок с результатом и просьбу подождать
   BX.hide(BX("block"));
   BX.hide(BX("process"));

   // Отслеживаем клик по надписи click Me
   // При клике запускаем функцию DEMOLoad()
   BX.bindDelegate(
      document.body, 'click', {className: 'css_ajax' },
      function(e){
         if(!e)
            e = window.event;
         
         DEMOLoad();
         return BX.PreventDefault(e);
      }
   );
   
});

</script>

<!-- При клике по надписи click Me выполнится AJAX-запрос -->
<div class="css_ajax">click Me</div>

<?
// Подключаем эпилог ядра Bitrix
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
