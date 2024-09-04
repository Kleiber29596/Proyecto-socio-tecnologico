<?php 
require_once 'controllers/MedicamentosController.php';
require_once 'controllers/PresentacionController.php';

$objeto         = new MedicamentosController();
$medicamentos   = $objeto->listarMedic();
$objeto2        = new PresentacionController();
$presentaciones = $objeto2->selectPresentacion();
?>
<div class="pagetitle">
    <h1>Medicamentos</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <p></p>
                    <!-- Button trigger modal  -->
                    <button title="Agregar Medicamentos" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalAgregarMedicamentos">
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="table-responsive">
                        <!-- Table with stripped rows -->
                        <table class="table table-bordered" id="tbl_medicamentos" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre_medicamento</th>
                                    <th>Presentacion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- /.container-fluid -->

<!-- Modal Agregar Especies-->
<div class="modal fade" id="modalAgregarMedicamentos" tabindex="-1" aria-labelledby="agregarMedicamentosModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarMedicamentosLabel">Agregar el medicamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formRegistrarMedicamentos">

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="estado">Medicamento</label>
                                <select class="select2-selection--single" name="r_medicamento" id="r_medicamento" style="width:100%">
                                    <option value="">Seleccione</option>
                                    <?php
                                foreach ($medicamentos  as  $medicamento) {
                                ?>
                                    <option value="<?= $medicamento['id_medicamento'] ?>">
                                        <?= $medicamento['nombre_medicamento']."-".$medicamento['categoria'] ?></option>
                                    <?php
                                }
                                ?>
                                </select>
                                <small id="emailHelp" class="form-text text-muted">Seleccione el medicamento
                                </small>
                            </div>
                            <div class="col-sm-6">
                                <label for="estado">Presentacion</label>
                                <select class="form-control" name="categoria" id="presentacion">
                                    <option value="">Seleccione</option>
                                    <?php
                                foreach ($presentaciones  as  $presentacion) {
                                ?>
                                    <option value="<?= $presentacion['id_presentacion'] ?>">
                                        <?= $presentacion['presentacion'] ?></option>
                                    <?php
                                }
                                ?>
                                </select>
                                <small id="emailHelp" class="form-text text-muted">Selecciona la presentacion del
                                    medicamento </small>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" title="Cerrar el modal"
                                data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" onclick="agregarMedicamentos()"
                                title="Guardar cambios"><i class="fas fa-save"></i> Guardar</button>
                        </div>
                </form>

            </div>

        </div>
    </div>
</div>