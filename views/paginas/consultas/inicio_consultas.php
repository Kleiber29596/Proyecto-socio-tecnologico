<?php 
    require_once 'controllers/MedicamentosController.php';
    require_once 'controllers/ConsultasController.php';
    require_once 'controllers/EspecialidadController.php';
    $objeto1        = new MedicamentosController();
    $objeto2        = new ConsultasController();
    $objeto3        = new EspecialidadController();
    $consultas      = $objeto2->selectTipoConsulta();
    $medicamentos   = $objeto1->selectMedicamentos();
    $especialidades = $objeto3->selectEspecialidad(); 
    
?>
<div class="pagetitle">
    <h1>Consultas</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <p></p>
                    <!-- Button trigger modal  -->
                    <button title="Agregar Especies" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalAgregarConsulta">
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="table-responsive">
                        <!-- Table with stripped rows -->
                        <table class="table table-bordered" id="tbl_consultas" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nº documento/Paciente</th>
                                    <th>Nombres/Apellidos</th>
                                    <th>Tipo Consulta</th>
                                    <th>Edad</th>
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


<!-- Modal Agregar Consulta-->
<div class="modal fade" id="modalAgregarConsulta" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalAgregarCitasLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarConsultasLabel">Agregar Consultas <i
                        class="fas fa-clipboard-check"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formRegistrarConsultas">
                    <!-- Step 1 -->
                    <div class="step" id="step-1">
                        <div class="row">
                            <div class="col-sm-11">
                                <div class="form-group">
                                    <label for="n_documento_persona">Número de documento</label>
                                    <input class="form-control" type="text" id="n_documento_persona"
                                        placeholder="Numero de documento">
                                    <input type="hidden" id="id_persona" value="">
                                </div>
                            </div>
                            <div class="col-sm-1"
                                style="display: flex; justify-content: flex-start; align-items: flex-end;">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" id="consultar_persona"
                                        title="Buscar persona"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="contenedor_datos_persona" style="display: none;">
                            <div class="col-sm-12">
                                <p>Datos del Paciente</p>
                                <div class="table-responsive tbl_personas">
                                    <table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <th>Nº documento</th>
                                            <th>Nombres</th>
                                            <th>edad</th>
                                            <th>Sexo</th>
                                            <th>Teléfono</th>
                                            <th>Dirección</th>
                                        </tr>
                                        <tr>
                                            <td id="n_documento"></td>
                                            <td id="nombres_apellidos_persona"></td>
                                            <td id="fecha_nac"></td>
                                            <td id="sexo_persona"></td>
                                            <td id="tlf_persona"></td>
                                            <td id="direccion_persona"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Step 2 -->
                    <div class="step" id="step-2" style="display: none;">
                        <div class="row">
                            <div class="form-group">
                                <input class="form-control" type="hidden" id="edad" placeholder="Edad">
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="rango_edad">Tipo de consulta</label>
                                    <select class="select2-selection--single" name="tipo_consulta" id="tipo_consulta"
                                        style="width:100%">
                                        <option value="">Seleccione</option>
                                        <?php foreach ($consultas as $consulta) { ?>
                                        <option value="<?= $consulta['id_tipo_consulta'] ?>">
                                            <?= $consulta['motivo'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="instrucciones">Diagnóstico</label>
                                    <textarea class="form-control" id="diagnostico" name="diagnostico" rows="3"
                                        placeholder="Ingrese el diagnóstico"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step" id="step-3" style="display: none;">
                        <p>Recipe Médico</p>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="medicamento">Medicamento</label>
                                    <select class="select2-selection--single" name="medicamento" id="medicamento"
                                        style="width:100%">
                                        <option value="">Seleccione</option>
                                        <?php foreach ($medicamentos as $medicamento) { ?>
                                        <option value="<?= $medicamento['id_presentacion_medicamento'] ?>">
                                            <?= $medicamento['nombre_medicamento'].'-'.$medicamento['presentacion'] ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    <small id="estadoHelp" class="form-text text-muted">Selecciona el
                                        medicamento</small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="dosis">Dosis</label>
                                    <input type="number" class="form-control" id="dosis" name="dosis"
                                        placeholder="Ingrese la dosis">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="dosis">Unidad de medida</label>
                                    <select class="form-control" name="medicamento" id="unidad_medida">
                                        <option value="">Seleccione</option>
                                        <option value="unidad">Unidad</option>
                                        <option value="pastilla">pastilla</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-4">
                                <label for="frecuencia">Frecuencia</label>
                                <div class="form-group input-horas">
                                    <input type="number" id="frecuencia" class="form-control" name="frecuencia" min="1"
                                        step="1" placeholder="ingrese la frecuecia">
                                    <span>horas</span>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label for="duracion">Duración</label>
                                <div class="form-group input-duracion">
                                    <input type="number" id="cantidad_duracion" class="form-control"
                                        name="cantidad_duracion" min="1" step="1" placeholder="ingrese la duración">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="duracion"></label>
                                <div class="form-group input-duracion">
                                    <select name="intervalo" id="intervalo" class="form-control"
                                        style="width: 100%; display: inline-block; margin-left: 10px;">
                                        <option value="días">Días</option>
                                        <option value="semanas">Semanas</option>
                                        <option value="meses">Meses</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-sm-1"
                                style="display: flex; justify-content: flex-start;align-items: flex-end;">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary btn-circle"
                                        id="agregar_medicamento_recipe" title="Agregar medicamento"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row" id="contenedor_datos_medicamentos" style="display: none;">
                            <div class="col-sm-12 table-responsive" id="">
                                <table class="table table-bordered table-striped table-hover tbl_medicamentos"
                                    id="multiples_medicamentos">
                                    <tr>
                                        <th>Medicamento</th>
                                        <th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </table>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="instrucciones">Instrucciones</label>
                                    <textarea class="form-control" id="instrucciones" name="instrucciones" rows="3"
                                        placeholder="Ingrese las instrucciones"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="prevBtn" style="display: none;"
                    onclick="nextPrev(-1)">Anterior</button>
                <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
                <button type="button" class="btn btn-secondary" title="Cerrar el modal"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="agregar_consulta" title="Guardar consulta"
                    style="display: none;"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
var currentStep = 1;
showStep(currentStep);

function showStep(step) {
    var steps = document.getElementsByClassName("step");
    for (var i = 0; i < steps.length; i++) {
        steps[i].style.display = "none";
    }
    steps[step - 1].style.display = "block";

    document.getElementById("prevBtn").style.display = step == 1 ? "none" : "inline";
    document.getElementById("nextBtn").style.display = step == steps.length ? "none" : "inline";
    document.getElementById("agregar_consulta").style.display = step == steps.length ? "inline" : "none";
}

function nextPrev(n) {
    var steps = document.getElementsByClassName("step");
    if (n == 1 && !validateForm()) return false;
    steps[currentStep - 1].style.display = "none";
    currentStep += n;
    if (currentStep > steps.length) {
        document.getElementById("formRegistrarConsultas").submit();
        return false;
    }
    showStep(currentStep);
}

function validateForm() {
    var valid = true;
    var inputs = document.querySelectorAll(".step:nth-child(" + currentStep + ") input");
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].value == "") {
            inputs[i].classList.add("is-invalid");
            valid = false;
        } else {
            inputs[i].classList.remove("is-invalid");
        }
    }
    return valid;
}
</script>