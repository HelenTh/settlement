<?php
namespace ClassNamesp;

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

?>