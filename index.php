<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Title");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/watch.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/client-plusone.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/ga.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/bootstrap.phone.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/searchvod_js.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/jquery-ui-1.10.4.custom.min.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/jquery.cookie.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/saved_resource");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/jquery.bxslider.min.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/jquery.pixlayout.0.9.7.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/jquery.validate.min.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/messages_ru.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/jquery.jcrop.min.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/dmuploader.min.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/jquery.selectboxit.min.js");
	$APPLICATION->SetAdditionalCSS("/podbor_obogrev_trub/selectboxit.css");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/jquery.maskedinput.min.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/highslide.min.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/cusel.js");
	$APPLICATION->SetAdditionalCSS("/podbor_obogrev_trub/style.css");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/main.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/script.js");
	$APPLICATION->AddHeadScript("/podbor_obogrev_trub/js_styles.js");
	CModule::IncludeModule('highloadblock');
	use Bitrix\Highloadblock as HL;
	use Bitrix\Main\Entity;
	$hlblock   = HL\HighloadBlockTable::getById(7)->fetch();
	$entity   = HL\HighloadBlockTable::compileEntity( $hlblock );
	$entity_data_class = $entity->getDataClass();
	$entity_table_name = $hlblock['TABLE_NAME'];
	$arFilter = array(); //задаете фильтр по вашим полям
	$sTableID = 'tbl_'.$entity_table_name;
	$rsData = $entity_data_class::getList(array(
	"select" => array('*'), //выбираем все поля
	"filter" => $arFilter,
	"order" => array("UF_SORT"=>"ASC") // сортировка по полю UF_SORT, будет работать только, если вы завели такое поле в hl'блоке
	));
	$rsData = new CDBResult($rsData, $sTableID);
	$type_trub=array();
	$frst_type_trub='';
	$for_el_type=array();
	while($arRes = $rsData->Fetch())
	{
		$for_el_type[$arRes['ID']]=$arRes['UF_XML_ID'];
		$type_trub[$arRes['ID']]=array('ID'=>$arRes['ID'],'NAME'=>$arRes['UF_NAME'],'CODE'=>$arRes['UF_XML_ID'],'IMG'=>CFile::GetPath($arRes['UF_FILE']));
		if($frst_type_trub==''){$frst_type_trub=$type_trub[$arRes['ID']];}
	}



	$hlblock   = HL\HighloadBlockTable::getById(8)->fetch();
	$entity   = HL\HighloadBlockTable::compileEntity( $hlblock );
	$entity_data_class = $entity->getDataClass();
	$entity_table_name = $hlblock['TABLE_NAME'];
	$arFilter = array(); //задаете фильтр по вашим полям
	$sTableID = 'tbl_'.$entity_table_name;
	$rsData = $entity_data_class::getList(array(
	"select" => array('*'), //выбираем все поля
	"filter" => $arFilter,
	"order" => array("UF_SORT"=>"ASC") // сортировка по полю UF_SORT, будет работать только, если вы завели такое поле в hl'блоке
	));
	$rsData = new CDBResult($rsData, $sTableID);
	$for_el_mat=$mat_trub=array();
	$frst_mat_trub='';
	while($arRes = $rsData->Fetch())
	{
		$for_el_mat[$arRes['ID']]=$arRes['UF_XML_ID'];
		$mat_trub[$arRes['ID']]=array('ID'=>$arRes['ID'],'NAME'=>$arRes['UF_NAME'],'CODE'=>$arRes['UF_XML_ID'],'IMG'=>CFile::GetPath($arRes['UF_FILE']));
		if($frst_mat_trub==''){$frst_mat_trub=$mat_trub[$arRes['ID']];}
	}





	$hlblock   = HL\HighloadBlockTable::getById(10)->fetch();
	$entity   = HL\HighloadBlockTable::compileEntity( $hlblock );
	$entity_data_class = $entity->getDataClass();
	$entity_table_name = $hlblock['TABLE_NAME'];
	$arFilter = array(); //задаете фильтр по вашим полям
	$sTableID = 'tbl_'.$entity_table_name;
	$rsData = $entity_data_class::getList(array(
	"select" => array('*'), //выбираем все поля
	"filter" => $arFilter,
	"order" => array("UF_SORT"=>"ASC") // сортировка по полю UF_SORT, будет работать только, если вы завели такое поле в hl'блоке
	));
	$rsData = new CDBResult($rsData, $sTableID);
	$for_el_termo=$termo_trub=array();
	$frst_termo_trub='';
	while($arRes = $rsData->Fetch())
	{
		$for_el_termo[$arRes['ID']]=$arRes['UF_XML_ID'];
		$termo_trub[$arRes['ID']]=$arRes;
		if($frst_termo_trub==''){$frst_termo_trub=$termo_trub[$arRes['ID']];}
	}



	$hlblock   = HL\HighloadBlockTable::getById(9)->fetch();
	$entity   = HL\HighloadBlockTable::compileEntity( $hlblock );
	$entity_data_class = $entity->getDataClass();
	$entity_table_name = $hlblock['TABLE_NAME'];
	$arFilter = array(); //задаете фильтр по вашим полям
	$sTableID = 'tbl_'.$entity_table_name;
	$rsData = $entity_data_class::getList(array(
	"select" => array('*'), //выбираем все поля
	"filter" => $arFilter,
	"order" => array("UF_SORT"=>"ASC") // сортировка по полю UF_SORT, будет работать только, если вы завели такое поле в hl'блоке
	));
	$rsData = new CDBResult($rsData, $sTableID);
	$for_el_greem=$greem_trub=array();
	$frst_greem_trub='';
	while($arRes = $rsData->Fetch())
	{
		$for_el_greem[$arRes['ID']]=$arRes['UF_XML_ID'];
		$greem_trub[$arRes['ID']]=array('ID'=>$arRes['ID'],'NAME'=>$arRes['UF_NAME'],'CODE'=>$arRes['UF_XML_ID'],'IMG'=>CFile::GetPath($arRes['UF_FILE']));
		if($frst_greem_trub==''){$frst_greem_trub=$greem_trub[$arRes['ID']];}
	}



	$hlblock   = HL\HighloadBlockTable::getById(6)->fetch();
	$entity   = HL\HighloadBlockTable::compileEntity( $hlblock );
	$entity_data_class = $entity->getDataClass();
	$entity_table_name = $hlblock['TABLE_NAME'];
	$arFilter = array(); //задаете фильтр по вашим полям
	$sTableID = 'tbl_'.$entity_table_name;
	$rsData = $entity_data_class::getList(array(
	"select" => array('*'), //выбираем все поля
	"filter" => $arFilter,
	"order" => array("ID"=>"ASC") // сортировка по полю UF_SORT, будет работать только, если вы завели такое поле в hl'блоке
	));
	$rsData = new CDBResult($rsData, $sTableID);
	$img=array();
	while($arRes = $rsData->Fetch())
	{
		$img[$arRes['UF_TYPE_TRUB'].'_'.$arRes['UF_MAT_TRUB'].'_'.$arRes['UF_GREEM'].'_'.$arRes['UF_IZOL']]=CFile::GetPath($arRes['UF_IMG']);
		if($frst_greem_trub==''){$frst_greem_trub=$greem_trub[$arRes['ID']];}
	}
	$ar_diametrs=array();
	foreach ($img as $key=>$val)
	{
		$ar_key=explode ('_',$key);
		$filter=array('IBLOCK_ID'=>6,'ACTIVE'=>'Y');
		if($ar_key[0]!=''&&$ar_key[0]!=0){$filter['PROPERTY_TYPE_TRUB']=$for_el_type[$ar_key[0]];}
		if($ar_key[1]!=''&&$ar_key[1]!=0){$filter['PROPERTY_MATERIAL_TRUB']=$for_el_mat[$ar_key[1]];}
		if($ar_key[2]!=''&&$ar_key[2]!=0){$filter['PROPERTY_GREEM']=$for_el_greem[$ar_key[2]];}
		$filter['!PROPERTY_DIAMETR_TRUBY']=false;
		$ob_el=CIBlockElement::GetList(Array("SORT"=>"ASC"),$filter,false,false,Array('PROPERTY_DIAMETR_TRUBY'));
		$ar_diametrs[$ar_key[0].'_'.$ar_key[1].'_'.$ar_key[2]]=array();
		while($ar_fields = $ob_el->GetNext())
		{
			if($ar_fields['PROPERTY_DIAMETR_TRUBY_VALUE']!=''){
			$ar_diametrs[$ar_key[0].'_'.$ar_key[1].'_'.$ar_key[2]][$ar_fields['PROPERTY_DIAMETR_TRUBY_VALUE']]=$ar_fields['PROPERTY_DIAMETR_TRUBY_VALUE'];
			}
		}
	}
?><div>
	<?foreach ($img as $key=>$src){?>
		<input id="<?=$key?>" value="<?=$src?>" type="hidden">
	<?}?>
</div>
<table width="100%" class="main_table" cellspacing="0" cellpadding="0" style="height:90%;     margin: 20px 0;">
        <tr>
      <td class="t6" id="main_content">                                                                                
<h1>Калькулятор расчета обогрева труб</h1>

<div class="wrap-pipe-calc " id="wrap_pipe_calc">
    
  <form action="" method="GET" id="calculate_form" style="">

    <div class="left-column">
      <div class="image-wrap">
        <img id="pipe_image" src="<?$img[$frst_type_trub['ID'].'_'.$frst_mat_trub['ID'].'_'.$frst_greem_trub['ID'].'_'.$frst_termo_trub['ID']]?>" alt="">
      </div>
    </div>
    
    <div class="step_wrap">
      <div class="step_strike">
        
        <div class="step active" id="step1">
          <h3>
            <span>Шаг 1.</span> Характеристики трубы<br/>
          </h3>

          <div class="step_inner">
            <h5>Труба</h5>
            <ul class="radio-list">
				<?$z=0;foreach ($type_trub as $type){?>
					<li><b><input class="radio-button" type="radio" name="pipe" id="pipe<?=$type['ID']?>" value="<?=$type['ID']?>" <?if($z==0){?>checked<?}?> ><label for="pipe<?=$type['ID']?>"><?=$type['NAME']?></label></b></li>
				<?$z++;}?>
            </ul>

            <h5>Материал трубы</h5>
            <ul class="radio-list">
				<?$z=0;foreach ($mat_trub as $mat){?>
              		<li><b><input class="radio-button" type="radio" name="pipe_material" id="pipe_material<?=$mat['ID']?>" value="<?=$mat['ID']?>" <?if($z==0){?>checked<?}?>><label for="pipe_material<?=$mat['ID']?>"><?=$mat['NAME']?></label></b></li>
				<?$z++;}?>
            </ul>

            <h5>Греем</h5>
            <ul class="radio-list">
				<?$z=0;foreach ($greem_trub as $greem){?>
              		<li><b><input class="radio-button" type="radio" name="heat" id="heat_in<?=$greem['ID']?>" value="<?=$greem['ID']?>" <?if($z==0){?>checked<?}?> ><label for="heat_in<?=$greem['ID']?>"><?=$greem['NAME']?></label></b></li>
				<?$z++;}?>
            </ul>

            <h5>Выберите диаметр трубы</h5>
            <select name="pipe_diametr" id="pipe_diametr" style="width:150px;"></select>
            <p class="annotation">Dy — наружный диаметр, Dn — внутренний диаметр, G" — размер резьбы</p>

            <h5>Введите длину трубы в метрах</h5>
            <input type="text" name="pipe_width" id="pipe_width" value="" class="input-text" style="width: 70px;">
            <br>
            <a href="#step2" class="continue">Продолжить</a>
          </div>
        </div><!-- step1 -->

        <div class="step" id="step2">
          <h3>
            <span>Шаг 2.</span> Характеристики теплоизоляции<br/>
          </h3>

          <div class="step_inner">
            <h5>Материал теплоизоляции</h5>
				<?$z=0;foreach ($termo_trub as $izol){?>
                        <div class="radio-with-annotation">
              <input type="radio" class="radio-button" data-prefix="peno" name="thermal_material" data-term="<?=$izol['UF_DESCRIPTION']?>" id="thermal<?=$izol['ID']?>" value="<?=$izol['ID']?>" <?if($z==0){?>checked<?}?>><label for="thermal<?=$izol['ID']?>"><?=$izol['UF_NAME']?></label>
                            <span class="question with-tooltip" title="<?=$izol['UF_FULL_DESCRIPTION']?>"></span>
              <p class="annotation">(Коэф. теплопроводности — <?=$izol['UF_DESCRIPTION']?>)</p>
                          </div>
			  <?$z++;}?>

              <div class="radio-with-annotation">
              	<input type="radio" class="radio-button" data-prefix="custom" name="thermal_material" id="thermal_material_4" value="0" ><label for="thermal_material_4">Пользовательский</label>
                            <p class="annotation">(Коэф. теплопроводности <input class="input-text" type="text" name="thermal_material_text" id="thermal_material_text" value="">)</p>
                          </div>
                        <a target="_blank" href="http://www.teplo-spb.ru/support?cat=7&article=308#таблица 3">Технические характеристики<br> теплоизоляционных материалов</a>

            <h5>Толщина теплоизоляции, мм</h5>
            <select name="thermal_thick" id="thermal_thick">
                            <option value="5"  >5</option>
                            <option value="10"  >10</option>
                            <option value="15"  >15</option>
                            <option value="20"  >20</option>
                            <option value="30"  >30</option>
                            <option value="40"  >40</option>
                            <option value="50"  >50</option>
                            <option value="60"  >60</option>
                            <option value="70"  >70</option>
                            <option value="80"  >80</option>
                            <option value="90"  >90</option>
                            <option value="100"  >100</option>
                            <option value="150"  >150</option>
                          </select>
            <span class="select-annotation">Экономически целесообразная<br> толщина теплоизоляции: <span class="color-red"><span id="recomend_thermal_thick">--</span> мм.</span></span>
          
            <a href="#step3" class="continue">Продолжить</a>
          </div>
        </div><!-- step2 -->

        <div class="step" id="step3">
          <h3>
            <span>Шаг 3.</span> Температурный режим<br/>
          </h3>

          <div class="step_inner">
            <span class="select-annotation clean">Температура внутри трубы, °C: +5°C</span>
            <h5>Температура на улице, °C</h5>
            <select name="temp_out" id="temp_out">
                            <option value="" selected ></option>
                            <option value="-5"  >-5</option>
                            <option value="-10"  >-10</option>
                            <option value="-15"  >-15</option>
                            <option value="-20"  >-20</option>
                            <option value="-25"  >-25</option>
                            <option value="-30"  >-30</option>
                            <option value="-35"  >-35</option>
                            <option value="-40"  >-40</option>
                            <option value="-45"  >-45</option>
                            <option value="-50"  >-50</option>
                          </select>
            <input class="input-text" style="width:50px; display:none;" type="text" name="temp_out_text" id="temp_out_text" value="">
            <!-- <span class="select-annotation">Температура внутри трубы,<br> °C: +5°C</span> -->
  

            <div class="wrap-checkbox">
              <input class="input-checkbox" type="checkbox" id="idont_now_temp" name="idont_now_temp" >
              <label for="idont_now_temp">Я не знаю, какую температуру на улице выбрать</label>
            </div>

            <div id="temp_custom" style="display: none;">
              <div class="wrap-radio-button">
                <input class="radio-button" type="radio" name="temp_out_custom" id="temp_out_custom_select" value="select" >
                <label for="temp_out_custom_select">Труба находится на воздухе или в земле на глубине до 0,4 м</label>
              </div>

              <div class="wrap-temp-out-select" style="display:none;">
                <p class="annotation">Выбирите ваш город (или наиболее близкий)</p>
                <select name="temp_out_select" id="temp_out_select">

					<option value="Пользовательский"  >Пользовательский</option>
					<option value="Архангельск"  >Архангельск</option>
					<option value="Астрахань"  >Астрахань</option>
					<option value="Барнаул"  >Барнаул</option>
					<option value="Белгород"  >Белгород</option>
					<option value="Березово"  >Березово</option>
					<option value="Верхоянск"  >Верхоянск</option>
					<option value="Витим"  >Витим</option>
					<option value="Владимир"  >Владимир</option>
					<option value="Вологда"  >Вологда</option>
					<option value="Воронеж"  >Воронеж</option>
					<option value="Дмитров"  >Дмитров</option>
					<option value="Екатеринбург"  >Екатеринбург</option>
					<option value="Иваново"  >Иваново</option>
					<option value="Иркутск"  >Иркутск</option>
					<option value="Йошкар-Ола"  >Йошкар-Ола</option>
					<option value="Казань"  >Казань</option>
					<option value="Калининград"  >Калининград</option>
					<option value="Калуга"  >Калуга</option>
					<option value="Карасук"  >Карасук</option>
					<option value="Кемь"  >Кемь</option>
					<option value="Кисловодск"  >Кисловодск</option>
					<option value="Кострома"  >Кострома</option>
					<option value="Котельниково"  >Котельниково</option>
					<option value="Краснодар"  >Краснодар</option>
					<option value="Курган"  >Курган</option>
					<option value="Курск"  >Курск</option>
					<option value="Липецк"  >Липецк</option>
					<option value="Магадан"  >Магадан</option>
					<option value="Майкоп"  >Майкоп</option>
					<option value="Махачкала"  >Махачкала</option>
					<option value="Москва"  >Москва</option>
					<option value="Мурманск"  >Мурманск</option>
					<option value="Находка"  >Находка</option>
					<option value="Нижний Новгород"  >Нижний Новгород</option>
					<option value="Новосибирск"  >Новосибирск</option>
					<option value="Оленек"  >Оленек</option>
					<option value="Оренбург"  >Оренбург</option>
					<option value="Пермь"  >Пермь</option>
					<option value="Псков"  >Псков</option>
					<option value="Ростов-на-Дону"  >Ростов-на-Дону</option>
					<option value="Рязань"  >Рязань</option>
					<option value="Самара"  >Самара</option>
					<option value="Санкт-Петербург"  >Санкт-Петербург</option>
					<option value="Саранск"  >Саранск</option>
					<option value="Сарапул"  >Сарапул</option>
					<option value="Саратов"  >Саратов</option>
					<option value="Смоленск"  >Смоленск</option>
					<option value="Тамбов"  >Тамбов</option>
					<option value="Тверь"  >Тверь</option>
					<option value="Томск"  >Томск</option>
					<option value="Тула"  >Тула</option>
					<option value="Тюмень"  >Тюмень</option>
					<option value="Усть-Камчатск"  >Усть-Камчатск</option>
					<option value="Уфа"  >Уфа</option>
					<option value="Ханты-Мансийск"  >Ханты-Мансийск</option>
					<option value="Чебоксары"  >Чебоксары</option>
					<option value="Челябинск"  >Челябинск</option>
					<option value="Чита"  >Чита</option>
					<option value="Элиста"  >Элиста</option>
					<option value="Южно-Сахалинск"  >Южно-Сахалинск</option>
					<option value="Якутск"  >Якутск</option>
					<option value="Ярославль"  >Ярославль</option>
                                  </select>
              </div>

              <div class="wrap-radio-button">
                <input class="radio-button" type="radio" name="temp_out_custom" id="temp_out_custom_m10" value="-10" >
                <label for="temp_out_custom_m10">Труба находится на глубине от 0,4 до 0,8 м</label>
              </div>
              <div class="wrap-radio-button">
                <input class="radio-button" type="radio" name="temp_out_custom" id="temp_out_custom_m5" value="-5" >
                <label for="temp_out_custom_m5">Труба находится на глубине 0,8 до 1,6 м</label>
              </div>
              <div class="wrap-radio-button">
                <input class="radio-button" type="radio" name="temp_out_custom" id="temp_out_custom_0" value="0" >
                <label for="temp_out_custom_0">Труба находится глубже 1,6 м</label>
              </div>
            </div>
          
            <a href="#step4" class="continue">Продолжить</a>
          </div>
        </div><!-- step3 -->

        <div class="step" id="step4">
          <h3>
            <span>Шаг 4.</span> Обогрев дополнительных элементов<br/>
            <span class="smallSpan"></span>
          </h3>


          <div class="step_inner">
            <p id="why_disabled">Ввод значений возможен только, если в шаге 1 выбрано назначение трубы - водопровод и греем трубу - снаружи</p>
            
            <!--div id="wrap_fittings">
              <div class="wrap-checkbox">
                <input class="input-checkbox" type="checkbox" name="fitting" id="fitting" >
                <label for="fitting" class="lbl-bold">Есть дополнительные элементы</label>
              </div>
            </div-->
          </div>

          <div class="step_inner">
            <div id="fittings">
              <div class="fitting-row">
                <input class="fitting-checkbox input-checkbox" type="checkbox" id="fittings_flanec" >
                <label for="fittings_flanec">Фланцы</label>
                <input class="input-text" type="text" name="fittings[flanec]" disabled value="">
                <span>шт.</span>
              </div>
              <div class="fitting-row">
                <input class="fitting-checkbox input-checkbox" type="checkbox" id="fittings_opori" >
                <label for="fittings_opori">Опоры</label>
                <input class="input-text" type="text" name="fittings[opori]" disabled value="">
                <span>шт.</span>
              </div>
              <div class="fitting-row">
                <input class="fitting-checkbox input-checkbox" type="checkbox" id="fittings_kran" >
                <label for="fittings_kran">Шаровой кран</label>
                <input class="input-text" type="text" name="fittings[kran]" disabled value="">
                <span>шт.</span>
              </div>
              <div class="fitting-row">
                <input class="fitting-checkbox input-checkbox" type="checkbox" id="fittings_zadvigka" >
                <label for="fittings_zadvigka">Задвижка</label>
                <input class="input-text" type="text" name="fittings[zadvigka]" disabled value="">
                <span>шт.</span>
              </div>
            </div><!-- fittings -->
          </div>
        </div><!-- step4 -->

      </div><!-- step_strike -->

      <div class="action-submit" id="action_submit">
        <p id="validation_error">Пожалуйста заполните все обязательные поля</p>
        <input type="hidden" name="a" value="calc">
        <button class="btn-submit" type="submit">Рассчитать</button>
        <p>Нажмите кнопку, чтобы расчитать обогрев труб</p>
      </div>
    </div>
  </form>  
</div>

<div style="clear:both;"></div>


<div style="clear:both;"></div>

<script type="text/javascript">



			var select_1_1_1=
			{
				"Выберите диаметр":"",
			  "Dy 15; G' 1/2; Dn 21,3":"Dy 15; G' 1/2; Dn 21,3",
			  "Dy 20; G' 3/4; Dn 26,8": "Dy 20; G' 3/4; Dn 26,8",
			  "Dy 25; G' 1;   Dn 33,5": "Dy 25; G' 1;   Dn 33,5"	
			};
			var select_1_1_2=
			{
				"Выберите диаметр":"",
				  "Dy 10;  G'' 3/8;   Dn 17": "Dy 10;  G'' 3/8;   Dn 17",
				  "Dy 15;  G' 1/2;   Dn 21,3": "Dy 15;  G' 1/2;   Dn 21,3",
				  "Dy 20;  G' 3/4;   Dn 26,8": "Dy 20;  G' 3/4;   Dn 26,8",
				  "Dy 25;  G' 1;     Dn 33,5": "Dy 25;  G' 1;     Dn 33,5",
				  "Dy 32;  G' 1 1/4; Dn 42,3":"Dy 32;  G' 1 1/4; Dn 42,3",
				  "Dy 40;  G' 1 1/2; Dn 48": "Dy 40;  G' 1 1/2; Dn 48",
				  "Dy 50;  G' 2;     Dn 60": "Dy 50;  G' 2;     Dn 60",
				  "Dy 65;  G' 2 1/2; Dn 75,5":"Dy 65;  G' 2 1/2; Dn 75,5",
				  "Dy 80;  G' 3;     Dn 88,5":"Dy 80;  G' 3;     Dn 88,5",
				  "Dy 90;  G' 3 1/2; Dn 101,3":"Dy 90;  G' 3 1/2; Dn 101,3",
				  "Dy 100; G' 4;     Dn 114":"Dy 100; G' 4;     Dn 114",
				  "Dy 125; G' 5;     Dn 140": "Dy 125; G' 5;     Dn 140",
				  "Dy 150; G' 6;     Dn 165": "Dy 150; G' 6;     Dn 165",
				  "Dy 160; G' 6 1/2": "Dy 160; G' 6 1/2",
				  "Dy 200": "Dy 200",
				  "Dy 225": "Dy 225",
				  "Dy 250": "Dy 250"
							};
			var select_1_2_1=
			{
				"Выберите диаметр":"",
				  "Dn 20; G' 1/2": "Dn 20; G' 1/2",
				  "Dn 25; G' 3/4": "Dn 25; G' 3/4",
				  "Dn 32; G' 1": "Dn 32; G' 1"
							};
			var select_1_2_2=
			{
				"Выберите диаметр":"",
				  "Dn 16;  G' 3/8": "Dn 16;  G' 3/8",
				  "Dn 20;  G' 1/2": "Dn 20;  G' 1/2",
				  "Dn 25;  G' 3/4": "Dn 25;  G' 3/4",
				  "Dn 32;  G' 1": "Dn 32;  G' 1",
				  "Dn 40;  G' 1 1/4": "Dn 40;  G' 1 1/4",
				  "Dn 50;  G' 1 1/2": "Dn 50;  G' 1 1/2",
				  "Dn 63;  G' 2": "Dn 63;  G' 2",
				  "Dn 75;  G' 2 1/2": "Dn 75;  G' 2 1/2",
				  "Dn 90;  G' 3": "Dn 90;  G' 3",
				  "Dn 110; G' 3 1/2": "Dn 110; G' 3 1/2",
				  "Dn 125; G' 4": "Dn 125; G' 4",
				  "Dn 140; G' 5": "Dn 140; G' 5",
				  "Dn 160; G' 6": "Dn 160; G' 6",
				  "Dn 180; G' 6 1/2": "Dn 180; G' 6 1/2",
				  "Dn 225": "Dn 225",
				  "Dn 250": "Dn 250",
				  "Dn 280": "Dn 280"
			};
			var select_2_1_1=
			{
				"Выберите диаметр":"",
				  "Dn 60; Dy 50": "Dn 60; Dy 50",
				  "Dn 110; Dy 100": "Dn 110; Dy 100",
				  "Dn 160; Dy 150": "Dn 160; Dy 150"
			};
			var select_2_1_2=
			{
				"Выберите диаметр":"",
				  "Dn 60; Dy 50": "Dn 60; Dy 50",
				  "Dn 110; Dy 100": "Dn 110; Dy 100",
				  "Dn 160; Dy 150": "Dn 160; Dy 150"
			};
			var select_2_2_1=
			{
				"Выберите диаметр":"",
				  "Dn 32": "Dn 32",
				  "Dn 40": "Dn 40",
				  "Dn 50": "Dn 50",
				  "Dn 63": "Dn 63",
				  "Dn 75": "Dn 75",
				  "Dn 110": "Dn 110",
				  "Dn 160": "Dn 160",
				  "Dn 200": "Dn 200",
				  "Dn 250": "Dn 250",
				  "Dn 315": "Dn 315",
				  "Dn 400": "Dn 400",
				  "Dn 500": "Dn 500"
			};
			var select_2_2_2=
			{
				"Выберите диаметр":"",
				  "Dn 32": "Dn 32",
				  "Dn 40": "Dn 40",
				  "Dn 50": "Dn 50",
				  "Dn 63": "Dn 63",
				  "Dn 75": "Dn 75",
				  "Dn 110": "Dn 110",
				  "Dn 160": "Dn 160",
				  "Dn 200": "Dn 200",
				  "Dn 250": "Dn 250",
				  "Dn 315": "Dn 315",
				  "Dn 400": "Dn 400",
				  "Dn 500": "Dn 500"
			};

	<?/*foreach ($ar_diametrs as $key=>$val){?>
		var select_<?=$key?>=
			{
				"Выберите диаметр":""<?if(count($val)>0){?>,<?}?>
				<?$z=0;$kol=count($val);foreach($val as $one){$z++;?>
				"<?=$one?>": "<?=$one?>"<?if($kol>$z){?>,<?}?>
				<?}?>
			};
													  <?}*/?>



var temp_out_city = {
  "Архангельск":"-31",
  "Астрахань":"-23",
  "Барнаул":"-39",
  "Белгород":"-23",
  "Березово":"-50",
  "Верхоянск":"-59",
  "Витим":"-51",
  "Владимир":"-28",
  "Вологда":"-32",
  "Воронеж":"-26",
  "Дмитров":"-28",
  "Екатеринбург":"-35",
  "Иваново":"-30",
  "Иркутск":"-36",
  "Йошкар-Ола":"-34",
  "Казань":"-32",
  "Калининград":"-19",
  "Калуга":"-27",
  "Карасук":"-37",
  "Кемь":"-27",
  "Кисловодск":"-16",
  "Кострома":"-31",
  "Котельниково":"-24",
  "Краснодар":"-19",
  "Курган":"-37",
  "Курск":"-26",
  "Липецк":"-27",
  "Магадан":"-29",
  "Майкоп":"-19",
  "Махачкала":"-14",
  "Москва":"-28",
  "Мурманск":"-27",
  "Находка":"-20",
  "Нижний Новгород":"-31",
  "Новосибирск":"-39",
  "Оленек":"-57",
  "Оренбург":"-31",
  "Пермь":"-35",
  "Псков":"-26",
  "Ростов-на-Дону":"-22",
  "Рязань":"-27",
  "Самара":"-30",
  "Санкт-Петербург":"-26",
  "Саранск":"-30",
  "Сарапул":"-34",
  "Саратов":"-27",
  "Смоленск":"-26",
  "Тамбов":"-28",
  "Тверь":"-29",
  "Томск":"-40",
  "Тула":"-27",
  "Тюмень":"-38",
  "Усть-Камчатск":"-28",
  "Уфа":"-35",
  "Ханты-Мансийск":"-41",
  "Чебоксары":"-32",
  "Челябинск":"-34",
  "Чита":"-38",
  "Элиста":"-23",
  "Южно-Сахалинск":"-24",
  "Якутск":"-54",
  "Ярославль":"-31"
};

function generate_option_pipe_diametr(values){
  html = "";
  checked_value = 0;
  checked = false;
  for(o in values){
    if(values[o] == checked_value) checked = true; else checked = false;
    html += '<option value="'+values[o]+'" '+ (checked ? "selected" : "") +' >'+o+'</option>';
  }
  return html;
}

$(document).ready(function()
{

	  $("select").selectBoxIt({autoWidth: false});

  $('#btn_unwrap_calc').click(function(e){
    $('#calculate_form').toggle();
    if($('#calculate_form').css('display') == 'none'){
      $('#wrap_pipe_calc').addClass('wrapped');
      $('#btn_unwrap_calc').text('Показать форму поиска');
      $(this).insertAfter($('.result-list'));
    }else{
      $('#wrap_pipe_calc').removeClass('wrapped');
      $('#btn_unwrap_calc').text('Скрыть форму поиска');
      $(this).insertAfter($('.image-wrap'));
    }
  });

  if($("input[name=pipe_material]:checked").length && $("input[name=heat]:checked").length && $("input[name=pipe]:checked").length){
    // options = generate_option_pipe_diametr( eval("select_" + $("input[name=pipe_material]:checked").val() + "_" + $("input[name=heat]:checked").val() ) );
    // $("#pipe_diametr").html(options);

    var pipe_material = $("input[name=pipe_material]:checked").val();
    var pipe = $("input[name=pipe]:checked").val();
    var heat = $("input[name=heat]:checked").val();
    if(pipe && heat && pipe_material){
      if(pipe == "canal"){
        select_name = "select_"+pipe+"_"+pipe_material;
      }else{
        select_name = "select_"+pipe+"_"+pipe_material+"_"+heat;
      }
      change_pipe_image();
      options = generate_option_pipe_diametr( eval(select_name) );
      $("#pipe_diametr").data("selectBox-selectBoxIt").add(options);
      $("#pipe_diametr").trigger("change");
    }

    show_hide_fittings();
  }

  if($("#thermal_material_text").val() == ""){
    $("#thermal_material_text").val( $("input[name=thermal_material]:checked").val() == "0" ? "" : $("input[name=thermal_material]:checked").data('term') );
  }else{
    $("#thermal_material_text").removeAttr("disabled");
  }

  $("input[name=thermal_material]").change(function(){
    if( $(this).val() == "0" ){
      $("#thermal_material_text").removeAttr("disabled").blur();
    }else{
      $("#thermal_material_text").attr("disabled", true).val($(this).data('term'));
    }

    change_pipe_image();

    set_step_2_result_text();
  });

  $('#thermal_thick').change(set_step_2_result_text);

  $("input[name=pipe_material], input[name=heat], input[name=pipe]").change(function(){
    var pipe_material = $("input[name=pipe_material]:checked").val();
    var pipe = $("input[name=pipe]:checked").val();
    var heat = $("input[name=heat]:checked").val();
    if(pipe && heat && pipe_material){
      if(pipe == "canal"){
        select_name = "select_"+pipe+"_"+pipe_material;
      }else{
        select_name = "select_"+pipe+"_"+pipe_material+"_"+heat;
      }
      change_pipe_image();
      options = generate_option_pipe_diametr( eval(select_name) );
      $("#pipe_diametr").data("selectBox-selectBoxIt").remove().add(options);
      $("#pipe_diametr").trigger("change");
    }

    show_hide_fittings();

    set_step_1_result_text();
  });

  $('#pipe_width').keyup(set_step_1_result_text);

  $("#pipe_diametr").change(function(){
    var val = $(this).val();
    var rtt = "--";

    if(val >= 15 && val < 20) rtt = 20;
    if(val >= 20 && val < 25) rtt = 20;
    if(val >= 25 && val < 32) rtt = 30;
    if(val >= 32 && val < 40) rtt = 30;
    if(val >= 40 && val < 50) rtt = 40;
    if(val >= 50 && val < 65) rtt = 50;
    if(val >= 65 && val < 80) rtt = 65;
    if(val >= 80 && val < 100) rtt = 100;
    if(val >= 100) rtt = 150;

    $("#recomend_thermal_thick").text(rtt);
    return false;
  });

  calc_total_price();
  $(".checkbox-related").change(calc_total_price);

  $("#calculate_form").submit(function(){
    var pipe_material = $("input[name=pipe_material]:checked").val();
    var pipe = $("input[name=pipe]:checked").val();
    var heat = $("input[name=heat]:checked").val();
    var width = $("input[name=pipe_width]").val();

    $('input, span.selectboxit').removeClass('validation-error');

    if($('#idont_now_temp').is(":checked")){
      var temp = $('#temp_out_text').val();
    }else{
      temp = $('#temp_out').val();
    }
    
    if( !(pipe_material && pipe && heat && width && temp) ){
      
      if(!width){
        $('.step').removeClass('active');
        $("#step1").addClass('active');
        $("input[name=pipe_width]").addClass('validation-error');
      }else if(!temp){
        $('.step').removeClass('active');
        $("#step3").addClass('active');

        if($('#idont_now_temp').is(":checked")){
          $('#temp_out_text').addClass('validation-error');
        }else{
          $('#temp_outSelectBoxIt').addClass('validation-error');
        }
      }

      $("#validation_error").show();
      return false;
    }else{
      $("#validation_error").hide();
      return true;
    }
  });

  $("#idont_now_temp").click(function(){
    show_tr_temp_custom($(this));
  });
  if($("#idont_now_temp").is(":checked")){
    show_tr_temp_custom($("#idont_now_temp"));
  }

  $("input[name=temp_out_custom]").click(function(){
    show_wrap_temp_out_select($(this));
  });
  show_wrap_temp_out_select($("input[name=temp_out_custom]:checked"));

  $("#temp_out_select").change(function(){
    $("#temp_out_text").val( temp_out_city[$(this).val()] );
    set_step_3_result_text();
  });

  $("#temp_out_text").focus(function(){
    $("#temp_out_select > option[value=Пользовательский]").attr("selected", true);
  });

  $("#temp_out_text").keyup(set_step_3_result_text);
  $("#temp_out").change(set_step_3_result_text);

  $(".fitting-checkbox").each(function(){
    if($(this).is(":checked")){
      var parent = $(this).closest(".fitting-row");
      parent.find("input[type=text]").removeAttr("disabled");
    }
  });
  $(".fitting-checkbox").change(function(){
    var parent = $(this).closest(".fitting-row");
    if($(this).is(":checked")){
      parent.find("input[type=text]").removeAttr("disabled").val(1);
    }else{
      parent.find("input[type=text]").attr("disabled", true).val("");
    }
    return false;
  });

  /*$("#calculate").click(function(){
    $(".result").hide();

    var L = parseInt($("#pipe_width").val(), 10);
    var lambda = $("#thermal_material").val();
    var d = parseInt($("#pipe_diametr").val(), 10);
    var t_out = parseInt($("#temp_out").val(), 10);

    if($("input[name=heat]:checked").val() == "out"){
      var D = (parseInt($("#thermal_thick").val(), 10) * 2) + d;
      
      var Qtr = ( 2 * Math.PI * lambda * L * (5 - t_out) * 1.3 )/(Math.log(D/d));
      console.log("Qtr=" + Qtr);
      $("#qtr").text( Math.round(Qtr) );
      $("#cabel_length").text("<неизвестно>");
      $("#result_out").show();
    }

    if($("input[name=heat]:checked").val() == "in"){
      var q = 9 * L;
      $("#q").text(q);

      var y = 0.91 * lambda * (5 - t_out);
      var s = d * ( (Math.pow(Math.E, y) - 1)/2 );
      
      if(s <= parseInt($("#thermal_thick").val(), 10)){
        $("#thermal_thick_text").text("Толщина теплоизоляции нормальная.");
        $("#result_thermal_thick").text("");
      }else{
        $("#result_thermal_thick").text( Math.round(s) + " мм." );
        $("#thermal_thick_text").text("Рекомендуемая толщина теплоизоляции не менее: ");
      }
      
      $("#result_in").show();
    }
  });*/
});

function show_tr_temp_custom(e){
  if( e.is(":checked") ){
    $("#temp_custom, #temp_out_text").show();
    $("#temp_out").data("selectBox-selectBoxIt").disable()
    $('#temp_outSelectBoxItContainer').hide();
    // $("#temp_out").attr("disabled", true);
  }else{
    $("#temp_custom, #temp_out_text").hide();
    $('#temp_outSelectBoxItContainer').show();
    $("#temp_out").data("selectBox-selectBoxIt").enable();
    // $("#temp_out").removeAttr("disabled");
  }
}

function show_wrap_temp_out_select(e){
  if( e.val() == "select" ){
    $(".wrap-temp-out-select").show();
    $("#temp_out_text").val( temp_out_city[$("#temp_out_select").val()] );
  }else{
    $(".wrap-temp-out-select").hide();
    $("#temp_out_text").val( e.val() );
  }

  if($("#temp_out_text").val() != '')
    set_step_3_result_text();
}

function calc_total_price(){
  var total_price = 0;
  $(".price").each(function(){
    if( $(this).closest("tr").find(".checkbox-related").is(":checked") ){
      total_price += parseInt( $(this).text().replace(' ', ''), 10 );
    }
  });
  $("#total_price").text( total_price.formatMoney(0, '.', ' ') );
}

function set_step_1_result_text(){
  var pipe_material = $("input[name=pipe_material]:checked").val(),
      pipe = $("input[name=pipe]:checked").val(),
      heat = $("input[name=heat]:checked").val(),
      pipe_width = $('#pipe_width').val(),
      pipe_diametr = $('#pipe_diametr').val();

  var pipe_material_text = {iron: 'железную', plastic: 'пластмассовую'},
      pipe_text = {vodoprovod: 'водопроводную', canal: 'канализационную'},
      heat_text = {in: 'внутри', out: 'снаружи'};

  var step_1_text = 'Вы выбрали '+
      pipe_material_text[pipe_material] +
      ' '+ pipe_text[pipe] +
      ' трубу с обогревом ' +
      heat_text[heat] +
      ', длиной ' + pipe_width + ' м ' +
      ' и диаметром ' + pipe_diametr + '.';
  $('#step1 .smallSpan').text(step_1_text);
}

function set_step_2_result_text(){
  var thermal_material = $('input[name=thermal_material]').val(),
      thermal_thick = $('#thermal_thick').val();

  var thermal_material_text = {
    '0.035': 'пеноплиэтилен',
    '0.037': 'минеральнаю вату',
    '0.022': 'скорлупы ППУ',
    'custom': 'пользовательский'
  };
  var step_2_text = 'Вы выбрали ' + thermal_material_text[thermal_material] + ' толщиной ' + thermal_thick + ' мм.'
  $('#step2 .smallSpan').text(step_2_text);
}

function set_step_3_result_text(){
  if($('#idont_now_temp').is(":checked")){
    var temp = $('#temp_out_text').val();
  }else{
    temp = $('#temp_out').val();
  }

  step_3_text = 'Вы выбрали ' + temp + '°C';
  $('#step3 .smallSpan').html(step_3_text);
}

function show_hide_fittings(){
  var pipe = $("input[name=pipe]:checked").val(),
      heat = $("input[name=heat]:checked").val();

  if(heat == "2" && pipe == "1"){
    $("#why_disabled").hide();
    $("#fittings").show();
    // $("#step4").removeClass('disabled');
  }else{
    $("#why_disabled").show();
    $("#fittings").hide();
    // $("#step4").addClass('disabled');
  }
}

function change_pipe_image(){
  var pipe_material = $("input[name=pipe_material]:checked").val();
  var pipe = $("input[name=pipe]:checked").val();
  var heat = $("input[name=heat]:checked").val();
	var thermal_material=$("input[name=thermal_material]:checked").val();

var src=$('#'+pipe+'_'+pipe_material+'_'+heat+'_'+thermal_material).val();
  // console.log(img_path);
  $('#pipe_image').attr('src', src);
}

</script>                        

              </td>
    </tr>
  </table>
<div class="resultat_serch"></div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>