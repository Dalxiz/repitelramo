<div class="container-fluid">
        <div class="col-lg-12 form-control h-100">
            <div class="row">
                <div class="col-lg-8 d-flex">
                    <div class="form-group col-lg-8">
                        <label for="">Mes</label>
                        <input type="month" name="fecha" id="fecha" class="form-control" value="2021-05">
                    </div>
                    <div class="form-group col-lg-4 pt-3 mt-3">
                        <button type="button" name="consulta"  id="consulta"class="btn btn-success"><i class="bi bi-search"></i> Generar</button>
                    </div>
                </div>                
            </div>
            <div class="row">
                <table class="table is-striped table-hover m-3">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Tipo Documento</th>
                            <th>Fecha Emisión</th>
                            <th>Cliente</th>
                            <th>Total Neto</th>
                            <th>IVA</th>
                            <th>Total Bruto</th>
                        </tr>
                    </thead>
                    <tbody id="resultado">
                    
                </tbody>   
                </table>
            </div>
        </div>
  </div>
  
  <!-- //Evento click sobre generar. -->
  <script src="/repitelramo/presentacion/dist/js/modalLibroVentas.js"></script>
     
    