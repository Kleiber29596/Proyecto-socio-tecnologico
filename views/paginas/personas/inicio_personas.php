<?php 
require_once 'controllers/PersonasController.php';
$objeto  = new PersonasController();
$estados = $objeto->selectEstado();
$update_estados = $objeto->selectEstado();
$update_municipios = $objeto->selectMunicipio();
$update_parroquias = $objeto->selectParroquia();
?>

<div class="pagetitle">
    <h1>Personas</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <p></p>
                    <!-- Button trigger modal  -->
                    <button title="Agregar Persona" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalAgregarPersona">
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="table-responsive">
                        <!-- Table with stripped rows -->
                        <table class="table table-bordered" id="tbl_personas" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nº documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Sexo</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Municipio</th>
                                    <th>Parroquia</th>
                                    <th>Correo</th>
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



<!-- Modal Agregar Persona -->
<div class="modal fade" id="modalAgregarPersona" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalAgregarPersonaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarPersonaLabel">Agregar Persona <i
                        class="fa fa-hospital-user"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formRegistrarPersona">

                    <!----------------- Grupo Nombres ----------------------->
                    <div class="row">
                        <div class="col-sm-6" id="grupo_nombres">
                            <label class="formulario__label" for="nombres">Nombres</label>
                            <div class="form-group">
                                <input class="form-control formulario__validacion__input" type="text" id="nombres"
                                    name="nombres" placeholder="Nombres">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El nombre debe contener Letras, numeros, guion y
                                guion_bajo</p>
                        </div>
                        <!----------------- Grupo Apellidos ----------------------->
                        <div class="col-sm-6" id="grupo_apellidos">
                            <label class="formulario__label" for="apellidos">Apellidos</label>
                            <div class="form-group ">
                                <input class="form-control formulario__validacion__input" type="text" id="apellidos"
                                    name="apellidos" placeholder="Apellidos">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El apellido debe contener Letras y espacios, pueden
                                llevar acentos.</p>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="formulario__label" for="tipo_documento">Tipo de documento</label>
                                <select class="form-control" name="tipo_documento" id="tipo_documento">
                                    <option value="">Seleccione</option>
                                    <option value="V">Venezolano</option>
                                    <option value="E">Extranjero</option>
                                    <option value="P">Pasaporte</option>
                                </select>
                            </div>
                        </div>
                        <!-------------------------- Grupo Nº documento ----------------------------------->

                        <div class="col-sm-6" id="grupo_n_documento">
                            <label class="formulario__label" for="n_documento">Numero de documento</label>
                            <div class="form-group">
                                <input class="form-control formulario__validacion__input" type="text" id="n_documento"
                                    name="n_documento" placeholder="numero de documento...">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El numero de documento debe contener solo numeros y un 8
                                digitos
                            </p>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="formulario__label" for="fecha_nac">Fecha de nacimiento</label>
                                <input type="date" class="form-control formulario__validacion__input" id="fecha_nac"
                                    name="fecha_nac">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="formulario__label" for="sexo">Sexo</label>
                                <select class="form-control formulario__validacion__input" name="sexo" id="sexo">
                                    <option value="">Seleccione</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!----------------- Grupo Teléfono ----------------------->

                    <div class="row" id="grupo_telefono">
                        <div class="col-sm-6">
                            <label class="formulario__label" for="telefono">Telefono</label>
                            <div class="form-group">
                                <input class="form-control formulario__validacion__input" type="text" id="telefono"
                                    name="telefono" placeholder="telefono...">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El numero de telefono debe contener solo numeros y 11
                                digitos
                            </p>
                        </div>
                        <!----------------- Grupo Correo ----------------------->

                        <div class="col-sm-6" id="grupo_correo">
                            <label class="formulario__label" for="correo">Correo</label>
                            <div class="form-group">
                                <input class="form-control formulario__validacion__input" type="email" id="correo"
                                    name="correo" placeholder="jhon@gmail.com">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos,
                                guiones.
                            </p>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select class="select2-selection--single" name="estado" id="estado" style="width:100%">
                                    <option value="">Seleccione</option>
                                    <?php foreach ($estados as $estado) { ?>
                                    <option value="<?= $estado['id_estado'] ?>"><?= $estado['estado'] ?></option>
                                    <?php } ?>
                                </select>
                                <small id="estadoHelp" class="form-text text-muted">Selecciona el estado</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="municipio">Municipio</label>
                                <select class="form-control formulario__validacion__input" name="municipio"
                                    id="municipio">
                                </select>
                                <small id="municipioHelp" class="form-text text-muted">Selecciona el
                                    municipio</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="parroquia">Parroquia</label>
                                <select class="form-control formulario__validacion__input" name="parroquia"
                                    id="parroquia">
                                </select>
                                <small id="parroquiaHelp" class="form-text text-muted">Selecciona la
                                    parroquia</small>
                            </div>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" title="Cerrar el modal"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="agregar_persona" title="Guardar cambios"><i
                        class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>