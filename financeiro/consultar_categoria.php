<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';

$objdao = new CategoriaDAO();
$categorias = $objdao->ConsultarCategoria();

/*echo'<pre>';
print_r($categorias);
echo'</pre>';*/
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">
            <?php
            include_once '_topo.php';
            include_once '_menu.php';
            ?>
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include_once '_msg.php' ?>
                            <h2>Consultar Categoria Financeira</h2>
                            <h5>Consulte todas suas categorias aqui! </h5>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span> Categorias cadastradas. Caso deseja alterar, clique no botão</span>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Nome da categoria</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for($i=0; $i<count($categorias) ; $i++){ ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $categorias[$i]['nome_categoria'] ?>
                                                 </td>
                                                    <td>
                                                        <a href= "alterar_categoria.php?cod=<?=$categorias[$i]['id_categoria'] ?>" class= "btn btn-warning btn-sm">Alterar</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
    </div>



</body>

</html>