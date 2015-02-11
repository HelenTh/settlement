<?php
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

?>