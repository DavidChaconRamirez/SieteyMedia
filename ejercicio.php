<?php
$palos= array("bastos","copas","espadas","oros");
 $cartas= array("As",2,3,4,5,6,7,"Sota","Caballo","Rey");
$otro="si";
do{
    //se inicializa en cada partida
    for($x=0;$x<count($palos);$x++) 
     {
        //echo "\n".$palos[$x];
        for($y=0;$y<count($cartas);$y++)
        {
                
            $encontrado[$x][$y]=false;
        }
    }
    
    echo "Bienvenido al black Jack \n";
    echo "El bojetivo del juego es acumular 7,5 Sin pasarse \n";
    echo "Tu oponente sera el propio ordenador\n";
    echo"\n\n";
    //este array guardara cartas ya vistas la usare como variable global
    juego($palos, $cartas);
    pintarbaraja($palos, $cartas,$encontrado);
    echo "\n Escribe SI para jugar otra vez:";
    $otro = trim(fgets(STDIN));
    $otro = strtolower($otro);
} while($otro=="si");
    echo "\n hasta otra ";
function juego($palos, $cartas){
  
   
    $contador[0]=0;
    $contador[1]=0;
    $inicio=0;
    $fin=false;
    
    
    while(!$fin)
    {
      
         if($contador[1]<=$contador[0] && $inicio==0)
        {
            echo "juega el usuario \n";
            $contador[1]+=tirada($palos, $cartas);  
            echo "\t \t los puntos acumulados por el jugador son $contador[1] \n";
            $inicio=1;
        }
         else{
            echo "Escribe P para pasar o C para continuar:";
            $line = trim(fgets(STDIN));
            if ($line=="P")
            {
                 echo "+++++++++++++++++++++++++++++++++++\n";
                 echo "el jugador ha decidido pasar turno \n";
                 echo "+++++++++++++++++++++++++++++++++++\n";
                 if($contador[0]<=$contador[1])
                    {
                        echo "juega la maquina \n";
                        $contador[0]+=tirada($palos, $cartas);
                        echo "\t \t los puntos acumulados por la maquina  son $contador[0] \n";

                    }
                    else{
                        echo "+++++++++++++++++++++++++++++++++++\n";
                        echo "La maquina ha decidido pasar turno \n";
                        echo "+++++++++++++++++++++++++++++++++++\n";
                    }
            }
            else if ($line=="C")
            {
                echo "juega el usuario \n";
                 $contador[1]+=tirada($palos, $cartas);  
                 echo "\t \t los puntos acumulados por el jugador son $contador[1] \n";
            }
        if ($contador[0]>7.5)
        {
            echo "Gano el jugador";
            $fin=true;
            return;
           
        }
             
        }
        echo"\n\n";
        if ($contador[1]>7.5 ||($contador[0]==$contador[1] && $fin))
        {
            echo "Gano la maquina \n";
            $fin=true;
            return;
        }
        elseif ($contador[0]>7.5 )
        {
            echo "gano el jugador";
            return;
           
        }
        echo"\n";
    }
}

function tirada($palos, $cartas)
{
global $encontrado; 
do{
 $palo=rand(0, 3);
 $carta=rand(0, 9 );
} while ($encontrado[$palo][$carta]==true);
$valor= valorc($cartas,$carta);
 echo "\t la carta elegida al azar es  $cartas[$carta] de $palos[$palo] y vale: $valor \n";
$encontrado[$palo][$carta]=true;
return $valor;
}
function valorc($cartas,$carta)
{
    if($cartas[$carta]=="As")
    {
    return 1;
    }
    elseif(is_numeric($cartas[$carta]))
    {
        return $cartas[$carta];
    }
    else
    {
        return 0.5;
    }
}
function pintarbaraja($palos, $cartas,$encontrado)
{
    
    for($x=0;$x<count($palos);$x++) 
    {
        echo "\n $palos[$x]";
        for($y=0;$y<count($cartas);$y++)
        {
            
            if(!$encontrado[$x][$y])
            {
                echo "$cartas[$y]:M  ";
            }else
            {
                echo "$cartas[$y]:X  ";
            }
            
        }
    }
}


