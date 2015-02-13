<?php
namespace ClassNamesp;

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

?>