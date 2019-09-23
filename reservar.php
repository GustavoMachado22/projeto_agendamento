<?php
require 'config.php';
require 'classes/periodos.class.php';
require 'classes/reservas.class.php';

$reservas = new Reservas($pdo);
$periodos = new Periodos($pdo);

if(!empty($_POST['periodo'])) {
    $periodo = addslashes($_POST['periodo']);
    $data_inicio = explode('/', addslashes($_POST['data_inicio']));
    $data_fim = explode('/',addslashes($_POST['data_fim']));
    $pessoa = addslashes($_POST['pessoa']);

    $data_inicio = $data_inicio[2].'-'.$data_inicio[1].'-'.$data_inicio[0];
    $data_fim = $data_fim[2].'-'.$data_fim[1].'-'.$data_fim[0];

    if($reservas->verificarDisponibilidade($periodo, $data_inicio, $data_fim)) 
    {
        $reservas->reservar($periodo, $data_inicio, $data_fim, $pessoa);
        header("Location: index.php");
        exit;

    } else {
        echo "Esta data ja está reservada.";
    }

}

?>

<h1>Adiconar Reserva</h1>

<form method="POST">
    Periodo:<br/>
    <select name="periodo">
        <?php
           $lista = $periodos->getPeriodos(); 

           foreach ($lista as $periodo):
            ?>
            <option value="<?php echo $periodo['id']?>"><?php echo $periodo['nome']; ?></option>
                <?php
           endforeach; 
        ?>
    </select><br/><br/>

    Data de início:<br/>
    <input type="text" name="data_inicio" /><br/><br/>

    Data do fim:<br/>
    <input type="text" name="data_fim"/><br/><br/>

    Nome da Pessoa:<br/>
    <input type="text" name="pessoa"/><br/><br/>

    <input type="submit" value="Reservar" />
</form>