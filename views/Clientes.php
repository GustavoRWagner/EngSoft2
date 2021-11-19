<?php
include(HEADER);
?>
<div id="modal-overlay" class="modal-overlay hide">
    <div class="modal-box">
        <h1 id="modal-title"></h1>
        <form id="editClienteForm" action="">
            <div class="row">
                <input id="form-type" type="hidden" value="">
                <input id="id" type="hidden" value="">
                <div class="col-12 mb-2">
                    <label for="nome">Nome:</label>
                    <input id="nome" name="nome" type="text" class="form-control">
                </div>
                <div class="col-12 mb-2">
                    <label for="endereco">Endereço:</label>
                    <input id="endereco" name="endereco" type="text" class="form-control">
                </div>
                <div class="col-12 mb-2">
                    <label for="telefone">Telefone</label>
                    <input id="telefone" name="telefone" type="text" class="form-control">
                </div>
                <div class="col-12 mb-2">
                    <label for="celular">Celular</label>
                    <input id="celular" name="celular" type="text" class="form-control">
                </div>
                <div class="col-12 mb-2">
                    <label for="cpf">CPF:</label>
                    <input id="cpf" name="cpf" type="text" class="form-control">
                </div>
                <div class="col-12 d-flex">
                    <div class="btn-success" onclick="saveAction()">Salvar</div>
                    <div class="btn-fail" onclick="cancelAction()">Cancelar</div>
                </div>
            </div>
        </form>
    </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="info-btn" onclick="addCliente()">Adicionar Cliente</div>
        </div>
        <div class="row">

            <?php foreach ($clientes as $cliente): ?>
                <div class="col-4">
                    <div class="row">
                        <div class="col-12">
                            <strong>Nome: </strong><spam id="nome-<?php echo $cliente['id']; ?>"><?php echo $cliente['nome']; ?></spam>
                        </div>
                        <div class="col-12">
                            <strong>Endreço: </strong><spam id="endereco-<?php echo $cliente['id']; ?>"><?php echo $cliente['endereco']; ?></spam>
                        </div>
                        <div class="col-12">
                            <strong>Telefone: </strong><spam id="telefone-<?php echo $cliente['id']; ?>"><?php echo $cliente['telefone']; ?></spam>
                        </div>
                        <div class="col-12">
                            <strong>Celular: </strong><spam id="celular-<?php echo $cliente['id']; ?>"><?php echo $cliente['celular']; ?></spam>
                        </div>
                        <div class="col-12">
                            <strong>CPF: </strong><spam id="cpf-<?php echo $cliente['id']; ?>"><?php echo $cliente['cpf']; ?></spam>
                        </div>
                        <div class="col-12 text-right d-flex">
                            <div onclick="editCliente(<?php echo $cliente['id']; ?>)"><i class="fas fa-edit"></i></div>
                            <div onclick="deleteCliente(<?php echo $cliente['id']; ?>)"><i class="fas fa-trash-alt"></i></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<script>
    function addCliente(){
        $("#modal-title").text("Adicionar Cliente");
        $("#form-type").val("create");

        $("#modal-overlay").removeClass("hide");
        $("#modal-overlay").addClass("show");
    }

    function editCliente(id){
        $("#modal-title").text("Editar Cliente");
        $("#form-type").val("edit");
        $("#id").val(id);
        $("#nome").val($("#nome-"+id).text());
        $("#endereco").val($("#endereco-"+id).text());
        $("#telefone").val($("#telefone-"+id).text());
        $("#celular").val($("#celular-"+id).text());
        $("#cpf").val($("#cpf-"+id).text());

        $("#modal-overlay").removeClass("hide");
        $("#modal-overlay").addClass("show");
    }
    function deleteCliente(id){
        var endpoint = "<?php echo SITE_URL;?>/cliente/delete/"+id
        request = $.ajax({
            url: endpoint,
            type: "post",
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR) {
            console.log(response);
            if (response == 1) {
                alert("deletado com sucesso!");
                cancelAction();
                window.location.reload();
            } else {
                alert("erro ao salvar" + response )
            }
        });

        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown) {
            // Log the error to the console
            console.error(
                "The following error occurred: " +
                textStatus, errorThrown
            );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            // Reenable the inputs
            // $inputs.prop("disabled", false);
        });
    }
    function cancelAction(){
        $("#modal-title").text("Editar Cliente");
        $("#form-type").val("");
        $("#nome").val("");
        $("#endereco").val("");
        $("#telefone").val("");
        $("#celular").val("");
        $("#cpf").val("");

        $("#modal-overlay").removeClass("show");
        $("#modal-overlay").addClass("hide");
    }
    function saveAction(){
        var endpoint = ""
        if($("#form-type").val() == 'edit'){
            endpoint = "<?php echo SITE_URL;?>/cliente/edit/"+$("#id").val()+"/"+$("#nome").val()+"/"+$("#endereco").val()+"/"+$("#telefone").val()+"/"+$("#celular").val()+"/"+$("#cpf").val()
        }
        if($("#form-type").val() == 'create'){
            endpoint = "<?php echo SITE_URL;?>/cliente/create/"+$("#nome").val()+"/"+$("#endereco").val()+"/"+$("#telefone").val()+"/"+$("#celular").val()+"/"+$("#cpf").val()
        }
        request = $.ajax({
            url: endpoint,
            type: "post",
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR) {
            console.log(response);
            if (response == 1) {
                alert("salvo com sucesso!");
                cancelAction();
                window.location.reload();
            } else {
                alert("erro ao salvar" + response )
            }
        });

        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown) {
            // Log the error to the console
            console.error(
                "The following error occurred: " +
                textStatus, errorThrown
            );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            // Reenable the inputs
            // $inputs.prop("disabled", false);
        });
    }
</script>

<?php
include(FOOTER);
?>
