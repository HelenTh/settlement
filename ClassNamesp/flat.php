<?php
namespace ClassNamesp;

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

?>