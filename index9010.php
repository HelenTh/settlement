<!DOCTYPE html>
<html>
    <head>
		<style>
		th, td {
			border: 2 px; 
			background-color: #DCE8DC;
			padding: 6px;
			font-size: small; 
			font-family: sans-serif; 
			text-align: center;
			color: #333366; 
		} 
		</style>
        <meta charset="UTF-8">
    </head>
    <body>


<?php
class Flat { // класс квартир  
		  public $num; 	
		  public $kol_room; 
		  public $sq_fl;
		  public $floor_fl;
		  public $kol_gil;
		  public $balk;
		  public $kol_balk;
		  public $type_otopl;
		  public function __construct( 
			  $k_r="отсутствует",
			  $s_f="отсутствует",
			  $fl="отсутствует",
			  $g="отсутствует",
			  $b="отсутствует",
			  $k_b="отсутствует",
			  $ot="отсутствует"){
			$this->kol_room = $k_r;
			$this->sq_fl = $s_f;
			$this->floor_fl = $fl;
			$this->kol_gil = $g;
			$this->balk = $b;
			$this->kol_balk = $k_b;
			$this->type_otopl = $ot;
		  }
		
		  public function show(){  //метод для отображения экземпляра класса Flat
		    $stroka="<tr>";
			foreach ($this as $name=>$value){
			 $stroka.="<td> " . $value . " </td>";
			}
			$stroka.="<td>" . $this->ras_kvpl() . "</td><td>" . $this->ras_otopl() . " </td><td>" . $this->ras_hol() . " </td><td>" 
			. $this->ras_gor() . " </td><td>" . $this->itog() . " </td></tr>";
			return $stroka;
			/*
		   $fl_pr = " <p><b><i>Квартира № $this->num</i></b></p>
		   <p>Количество комнат $this->kol_room</p>
			<p>Площадь квартиры $this->sq_fl </p>
			<p>Этаж $this->floor_fl </p>
			<p>Количество жильцов $this->kol_gil </p>
			<p>Есть балкон? $this->balk </p>
			<p>Количество балконов $this->kol_balk </p>
			<p>Тип отопления $this->type_otopl </p>";
			echo $fl_pr;
			*/
		  }
			public function del_gil($g=1){		// метод для удаления жильцов
			if ($g>$this->kol_gil) echo "Нельзя удалить $g жильцов, их всего " . $this->kol_gil; 
			else {
				$this->kol_gil = $this->kol_gil - $g;
				echo "Удаление $g жильцов выполнено. Теперь количество жильцов " . $this->kol_gil;
				}
			}
			public function add_gil($g=1){		// метод для добавления жильцов
				$this->kol_gil = $this->kol_gil + $g;
				echo "Добавление $g жильцов выполнено. Теперь количество жильцов " . $this->kol_gil;
			}
			public function ras_kvpl(){  // метод для расчета квартплаты
				$tarif=2.5;
				$kp=$tarif*$this->sq_fl;
				return $kp;
			}
			public function ras_otopl(){  // метод для расчета отопления
				$tarif_vod=6;
				$tarif_gaz=12;
				if ($this->type_otopl=="водян.") $kp=$tarif_vod*$this->sq_fl;
				else $kp=$tarif_gaz*$this->sq_fl;
				return $kp;		
			}
			public function ras_hol(){  // метод для расчета холодной воды
				$tarif=27;
				$kp=$tarif*$this->kol_gil;
				return $kp;
			}
			public function ras_gor(){  // метод для расчета горячей воды
				$tarif=35;
				$kp=$tarif*$this->kol_gil;
				return $kp;	
			}
			public function itog(){  // метод для расчета итоговой суммы
				$it_kp=$this->ras_otopl()+$this->ras_kvpl()+$this->ras_hol()+$this->ras_gor(); 
				return $it_kp;
			}		
}
class House {  // класс домов
		  public $num; 	
		  public $kol_floor; 
		  public $kol_pod;
		  public $sq_pril;
		  public $kvart ;
		  public function __construct( 
			  $n="отсутствует",
			  $k_f="отсутствует",
			  $k_p="отсутствует",
			  $s_p="отсутствует"
			  ){
			$this->num = $n;
			$this->kol_floor = $k_f;
			$this->kol_pod = $k_p;
			$this->sq_pril = $s_p;
			$this->kvart[] = new Flat;
			}
		  public function show(){ // метод для отображения инфо из эксземпляра класса House
		  $stroka="<tr>";
			foreach ($this as $name=>$value){
			 if ($name=="kvart") $stroka.="<td> " . count($value) . " </td>";
			 else $stroka.="<td> " . $value . " </td>";
			}
			$stroka.="<td>" . $this->ras_kp() . "</td><td>" . $this->ras_elect() . " </td><td>" . $this->ras_nalog() . " </td></tr>";
			return $stroka;
			/*
		   $hs_pr = " <h4>Дом № $this->num</h4>
			<p>Количество этажей $this->kol_floor </p>
			<p>Количество подъездов $this->kol_pod </p>
			<p>Прилегающая территория $this->sq_pril </p>
			<p>Количество квартир " . count($this->kvart) . "</p>";
			echo $hs_pr;
			*/
		  }
		  public function show_kvart(){ // метод для отображения инфо о всех квартирах в доме
		   	echo "<h4>Квартиры в доме № $this->num </h4>";
			$table_kv="<table><tr><th>Квартира №</th><th>Количество<br>комнат</th><th>Площадь<br>квартиры</th><th>Этаж</th>".
			"<th>Количество<br>жильцов</th><th>Есть<br>балкон?</th><th>Количество<br>балконов</th><th>Тип<br>отопления </th>".
			"<th>Квартплата</th><th>Отопление</th><th>Холодная<br>вода</th><th>Горячая<br>вода</th><th>ИТОГО<br>коммун.<br>услуги</th></tr>";
			foreach ($this->kvart as $kv){
					$table_kv.=$kv->show();
			}
			$table_kv.= "</table>";
			echo $table_kv;
		  }
			public function ras_elect(){  // метод для расчета электричества
				$tarif=3.5; //тариф на этаж
				$kp=$tarif*$this->kol_pod*$this->kol_floor;
				return $kp;
			}
			public function ras_nalog($stavka=60){  // метод для расчета налога на землю
				$nalog=$stavka*$this->sq_pril;
				return $nalog;		
			}
			public function ras_kp(){  // метод для расчета коммунальных платежей
				$kp=0;
				foreach ($this->kvart as $kv) {
				$kp+=$kv->itog(); 
				}
				return $kp;
			}
}
class Street {  //класс улиц
		  public $name; 	
		  public $lenth_st; 
		  public $start_st;
		  public $end_st;
		  public $doma ;
		  public function __construct( 
			  $n="отсутствует",
			  $l_f="отсутствует",
			  $s="отсутствует",
			  $e="отсутствует"
			  ){
			$this->name = $n;
			$this->lenth_st = $l_f;
			$this->start_st = $s;
			$this->end_st = $e;
			$this->doma[] = new House;
			}
		  public function show(){   //метод для отображения экземпляра класса Street
			$stroka="<tr>";
			foreach ($this as $name=>$value){
			 if ($name=="doma") $stroka.="<td> " . count($value) . " </td>";
			 else $stroka.="<td> " . $value . " </td>";
			}
			$stroka.="<td>" . $this->ras_kp() . "</td><td>" . $this->ras_dvorn() . " </td></tr>";
			return $stroka;
		  /*
		   $st_pr = " <h4>Улица $this->name</h4>
			<p>Длина улицы $this->lenth_st </p>
			<p>Начальные координаты $this->start_st </p>
			<p>Конечные координаты $this->end_st </p>
			<p>Количество домов " . count($this->doma) . "</p>";
			echo $st_pr;
			*/
		  }
		  public function show_doma(){ // метод для отображения инфо о всех домах на улице
		   	echo "<h4>Дома на улице  $this->name: </h4>";
			$table_dm="<table><tr><th>Дом №</th><th>Количество<br>этажей</th><th>Количество<br>подъездов</th><th>Прилегающая<br>территория</th>".
			"<th>Количество<br>квартир</th><th>Коммунальные<br>услуги</th><th>Потребляемое<br>электричество</th><th>Налог<br>на землю</th></tr>";
			foreach ($this->doma as $dm){
					$table_dm.=$dm->show();
			}
			$table_dm.= "</table>";
			echo $table_dm;
		  }
		  	public function ras_dvorn($norma=0.02){  // метод для расчета количества дворников
				$dvor=0;
				foreach ($this->doma as $dm) {
					$dvor+=ceil($dm->sq_pril*$norma); 
				}
				return $dvor;		
			}
			public function ras_kp(){  // метод для расчета коммунальных платежей
				$kp=0;
				foreach ($this->doma as $dm) {
				$kp+=$dm->ras_kp(); 
				}
				return $kp;
			}
}

class Settle {  //класс нас. пункт
		  public $name; 	
		  public $koord; 
		  public $year_osn;
		  public $streets ;
		  public function __construct( 
			  $n="отсутствует",
			  $ko="отсутствует",
			  $y="отсутствует"
			  ){
			$this->name = $n;
			$this->koord = $ko;
			$this->year_osn = $y;
			$this->streets[] = new Street;
			}
		  public function show(){   //метод для отображения экземпляра класса Settle
		   $se_pr = " <h3>Населенный пункт $this->name</h3>
			<p>Географические координаты $this->koord </p>
			<p>Год основания $this->year_osn </p>
			<p>Количество улиц " . count($this->streets) . "</p>";
			echo $se_pr;
		  }
		  public function show_streets(){ // метод для отображения инфо о всех улицах в нас. пункте
		   	echo "<h4>Улицы в $this->name: </h4>";
			$table_st="<table><tr><th>Улица</th><th>Длина<br>улицы</th><th>Начальные<br>координаты</th><th>Конечные<br>координаты</th>".
			"<th>Количество<br>домов</th><th>Коммунальные<br>услуги</th><th>Количество<br>дворников</th></tr>";
			foreach ($this->streets as $st){
					$table_st.=$st->show();
			}
			$table_st.= "</table>";
			echo $table_st;
		  }
		  	public function ras_budg(){  // метод для расчета бюджета
				$oth_doh=235000; // другие доходы
				$rash=189000;
				$it_nalog=0;
				foreach ($this->streets as $str) { // налог на землю итого
					foreach ($str->doma as $dm) {
						$it_nalog+=$dm->ras_nalog(); 
					}
				}
				$dohod=$oth_doh+$it_nalog;
				echo "<p>&nbsp;&nbsp;&nbsp;Доходы $dohod, в т.ч.</p>";
				echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Налог на землю $it_nalog</p>";
				echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Другие доходы $oth_doh</p>";
				echo "<p>&nbsp;&nbsp;&nbsp;Расходы $rash </p>";
			}
			public function ras_nass(){  // метод для расчета количества населения
				$nass=0; 
				foreach ($this->streets as $str) { 
					foreach ($str->doma as $dm) {
						foreach ($dm->kvart as $kv) {
							$nass+=$kv->kol_gil; 
						} 
					}
				}
				return $nass;
			}
			public function ras_kp(){  // метод для расчета коммунальных платежей
				$kp=0;
				foreach ($this->streets as $str) {
					$kp+=$str->ras_kp(); 
				}
				return $kp;
			}
}
$sett=new Settle;  // создание экземпляра нас. пункта
$sett->name = "Харьков";
$sett->koord = "50°00'N 36°13'E";
$sett->year_osn = "1654";

$name_street=array("Пушкинская","Рымарская","Героев Труда","Гагарина","Светлая","Виноградная");
for ($y=0; $y<=2; ++$y) {
	$sett->streets[$y]=new Street;  // создание экземпляра улицы
	do { // два цикла для поиска уникального названия улицы для массива объектов улиц
		$new_str=$name_street[rand (0,5)];
		if ($y==0) $prii=true; // для первой улицы проверка на уникальность не выполняется
		for ($k=0; $k<$y; ++$k) {
			if ($new_str==$sett->streets[$k]->name) {$prii=false; break;}
			$prii=true; // нашли улицу, которой еще не было в массиве объектов улиц
		}
	}
	while (!$prii);
	$sett->streets[$y]->name = $new_str;
	$sett->streets[$y]->lenth_st = (float) (rand (50,200) . "." . rand (1,99));
	$sett->streets[$y]->start_st = "50°". rand (0,60) . "'N 36°" . rand (0,60) . "'E ";
	$sett->streets[$y]->end_st = "50°". rand (0,60) . "'N 36°" . rand (0,60) . "'E ";
	for ($j=0; $j<=2; ++$j) {			
		$sett->streets[$y]->doma[$j] = new House;  // создание экземпляра дома
		$sett->streets[$y]->doma[$j]->num = rand (1,200);
		$sett->streets[$y]->doma[$j]->kol_floor = rand (5,16);
		$sett->streets[$y]->doma[$j]->kol_pod = rand (2,6);
		$sett->streets[$y]->doma[$j]->sq_pril = (float) (rand (50,200) . "." . rand (1,99));
			for ($i=0; $i<=3; ++$i) {
				$sett->streets[$y]->doma[$j]->kvart[$i] = new Flat; // создание экземпляра квартиры
				$sett->streets[$y]->doma[$j]->kvart[$i]->num = rand (1,200);
				$sett->streets[$y]->doma[$j]->kvart[$i]->kol_room = rand (1,5);
				$sett->streets[$y]->doma[$j]->kvart[$i]->sq_fl = (float) (rand (30,150) . "." . rand (1,9));
				$sett->streets[$y]->doma[$j]->kvart[$i]->floor_fl = rand (1,$sett->streets[$y]->doma[$j]->kol_floor);
				$sett->streets[$y]->doma[$j]->kvart[$i]->kol_gil = rand (0,10);
				$sett->streets[$y]->doma[$j]->kvart[$i]->balk = "есть";
				$sett->streets[$y]->doma[$j]->kvart[$i]->kol_balk = rand (1,2);
				$sett->streets[$y]->doma[$j]->kvart[$i]->type_otopl = "водян.";
			}
	}
}
$sett->show();
echo "<p>Коммунальные услуги " . $sett->ras_kp() . "</p>";
echo "<p>Количество населения " . $sett->ras_nass() . "</p>";
echo "<p><b>Бюджет</b></p>";
$sett->ras_budg();
$sett->show_streets(); //выводим таблицу улиц
foreach ($sett->streets as $str) { //выводим для каждой улицы таблицу домов
	echo "<h3>Улица $str->name</h3>";
	$str->show_doma();
	foreach ($str->doma as $dm) { //выводим для каждого дома таблицу квартир
		$dm->show_kvart(); 
		}
	}

// 

/*
	
*/	

?>