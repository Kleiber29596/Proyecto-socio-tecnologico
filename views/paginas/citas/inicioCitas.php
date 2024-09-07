<?php
require_once 'controllers/EspecialidadController.php';
$objeto  = new EspecialidadController();
$especialidad = $objeto->selectEspecialidad();
$update_especialidad = $objeto->selectEspecialidad();
/*require_once 'controllers/CitasController.php';
$objeto  = new CitasController();
$estados = $objeto->selectEstado();
$update_estados = $objeto->selectEstado();
$update_municipios = $objeto->selectMunicipio();
$update_parroquias = $objeto->selectParroquia();*/
?>

<div class="pagetitle">
    <h1>Citas</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-body">
                    <p></p>
                    <!-- Button trigger modal  -->
                    <!--<button title="Agregar Persona" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalAgregarPersona">
                        <i class="fas fa-plus"></i>
                    </button>-->
                    <div class="table-responsive">
                        <!-- Table with stripped rows -->
                        <table class="table table-bordered mt-3" id="tabla_citas" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Cedula/P</th>
                                    <th>Nombre y Apellido</th>
                                    <th>Fecha cita</th>
                                    <th>Especialidad</th>
                                    <th>Estatus</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="form-group mt-3">
                            <label class="formulario__label" for="tipo_documento">Especialidad</label>
                            <select class="form-control" name="tipo_documento" id="tipo_documento">
                                <option value="">Seleccione</option>
                                <?php
                                foreach ($update_especialidad  as  $update_especialidad) {
                                ?>
                                    <option value="<?= $update_especialidad['id_especialidad'] ?>"><?= $update_especialidad['nombre_especialidad'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="formulario__label mt-4" for="tipo_documento">Doctor</label>
                            <select class="form-control" name="tipo_documento" id="tipo_documento">
                                <option value="#">Seleccione</option>
                                <option value="V">Venezolano</option>
                                <option value="E">Extranjero</option>
                                <option value="P">Pasaporte</option>
                            </select>
                        </div>
                        <div class="mt-3" id="calendar">
                            
                        </div>
                        <button title="Agregar Persona" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalAgregarCitas">
                        <i class="fas fa-plus"> Agregar cita</i>
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Modal Agregar Cita -->
<div class="modal fade" id="modalAgregarCitas" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalAgregarCitasLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarCitasLabel">Agregar Cita <i class=" fa fa-solid fa-clipboard-check"> </i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formRegistrarCita">
                    <div class="row">
                        <div class="col-sm-2" style="display: flex;
                        justify-content: flex-start;
                        align-items: flex-end;">
                            <div class="form-group">
                                <label for="">Tipo de documento </label>
                                <select class="form-control" name="tipo_documento" id="tipo_documento_persona">
                                    <option value="">Seleccione</option>
                                    <option value="V">V</option>
                                    <option value="E">E</option>
                                    <option value="P">P</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label for="n_documento">Número de documento</label>
                                <input class="form-control" type="text" id="n_documento_persona" placeholder="Ingrese el número de documento del paciente">
                                <input type="hidden" id="id_persona" value="">
                            </div>
                        </div>
                        <div class="col-sm-1" style="display: flex;justify-content: flex-start; align-items: flex-end;">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="consultar_persona" title="Buscar paciente"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="contenedor_datos_persona" style="display: none;">
                        <div class="col-sm-12">
                            <p>Datos del Paciente</p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <tr>
                                        <th>Nº documento</th>
                                        <th>Nombres/Apellidos</th>
                                        <th>Telefono</th>
                                        <th>Sexo</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Dirección</th>  
                                    </tr>
                                    <tr>
                                        <td id="n_documento"></td>
                                        <td id="nombres_apellidos_persona"></td>
                                        <td id="tlf_persona"></td>
                                        <td id="sexo_persona"></td>
                                        <td id="fecha_nac"></td>
                                        <td id="direccion_persona"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="especialidad">Especialidad</label>
                            <select class="form-control" name="especialidad" id="especialidad">
                                <option value="">Seleccione</option>
                                <?php
                                foreach ($especialidad  as  $especialidad) {
                                ?>
                                    <option value="<?= $especialidad['id_especialidad'] ?>"><?= $especialidad['nombre_especialidad'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <small id="emailHelp" class="form-text text-muted">Selecciona la especialidad</small>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="doctor">Doctor</label>
                                <select class="form-control" name="doctor" id="doctor">

                                </select>
                                <small id="emailHelp" class="form-text text-muted">Selecciona el doctor </small>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Fecha de la cita</label>
                                <input type="date" id="fecha_cita" class="form-control rounded" min="">
                            </div>
                        </div>
                        <div class="col-sm-5" id="contenedor_citas_disponibles" style="display: none;">
                            <div class="form-group">
                                <table class="table table-bordered table-striped table-hover">
                                    <tr>
                                        <th class="text-center"><button class="btn btn-primary">Citas Disponibles <i class=" fa fa-solid fa-clipboard-check"> </i></button></th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <button class='btn btn-success' id="citas_disponibles"></button>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class="row" id="contenedor_estatus_observacion" style="display: none;">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="estatus">Estatus</label>
                                    <select class="form-control" name="estatus_cita" id="estatus_cita">
                                    <option value="0">Pendiente</option>
                                        <option value="1">Finalizado</option>
                                        <option value="2">Inasistente</option>
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted">Selecciona el estatus </small>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Observaciòn</label>
                                    <textarea class="form-control" id="observacion_cita" rows="3"></textarea>
                                </div>
                                <small>Ingresa una breve observaciòn</small>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" title="Cerrar el modal" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="agregar_cita" title="Guardar cita"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>