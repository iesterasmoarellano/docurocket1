<?php include('header.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include('header_options.php'); ?>
        <?php include('menu.php'); ?>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><label id="lblTramiteDia"></label></h3>
                                    <p>Trámites del día</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><label id="lblTramiteAtendido"></label></h3>
                                    <p>Trámites atendidos</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-android-checkmark-circle"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><label id="lblTramitePendiente"></label></h3>
                                    <p>Trámites pendientes</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-android-open"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><label id="lblTotalTramite"></label></h3>
                                    <p>Total de trámites</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-paper"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>

                <hr>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                              <div class="card-header border-0">
                                <div class="d-flex justify-content-center align-items-center">
                                  <h3 class="card-title">Cantidad de trámites registrados por día (últimos 7 días)</h3>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="position-relative mb-4">
                                  <canvas id="cnvTramiteRegistrado" height="150"></canvas>
                                </div>
                              </div>
                            </div>

                            <div class="card">
                              <div class="card-header border-0">
                                <div class="d-flex justify-content-center align-items-center">
                                  <h3 class="card-title">Cantidad de trámites finalizados por día (últimos 7 días)</h3>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="position-relative mb-4">
                                  <canvas id="cnvTramiteFinalizado" height="150"></canvas>
                                </div>
                              </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                              <div class="card-header border-0">
                                <div class="d-flex justify-content-center align-items-center">
                                  <h3 class="card-title">Cantidad de trámites en proceso por día (últimos 7 días)</h3>
                                </div>
                              </div>
                              <div class="card-body">

                                <div class="position-relative mb-4">
                                  <canvas id="cnvTramiteProceso" height="150"></canvas>
                                </div>
                              </div>
                            </div>

                            <div class="card">
                              <div class="card-header border-0">
                                <div class="d-flex justify-content-center align-items-center">
                                  <h3 class="card-title">Cantidad de trámites localizados por día (últimos 7 días)</h3>
                                </div>
                              </div>
                              <div class="card-body">

                                <div class="position-relative mb-4">
                                  <canvas id="cnvTramitesLocalizados" height="|50"></canvas>
                                </div>
                              </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>
        </div>
        <?php include('footer.php'); ?>
    </div>
    <?php include('scripts.php'); ?>

    <script src="../js/DAO/indexDAO.js" type="text/javascript"></script>

    <script>
        $(function () {
            $(document).ready(function () {

                indexDAO.getTramiteDia();
                indexDAO.getTramitePendientes();
                indexDAO.getTotalTramites();

                indexDAO.getGraficoTramiteRegistrado();
                indexDAO.getGraficoTramiteFinalizado();
                indexDAO.getGraficoTramiteProceso();
                indexDAO.getGraficoTramiteLocalizado();

            });
        });

        function getTramitesPendientes(){
            indexDAO.getTramitePendientePorcentaje();
        }

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
          }

          var mode = 'index'
          var intersect = true

    </script>

</body>
</html>