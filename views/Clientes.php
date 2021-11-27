<?php
include(HEADER);
?>
<div id="response-msg" class="hide">
    <h1 id="response-txt" class="w-100 text-center"></h1>
    <div id="confirm" class="btn-success" onclick="reloadPage()">Ok!</div>
</div>
<div id="modal-overlay" class="modal-overlay hide">
    <div class="modal-box">
        <h1 id="modal-title"></h1>
        <form id="editClienteForm" action="">
            <div class="row">
                <input id="form-type" type="hidden" value="">
                <input id="id" type="hidden" value="">
                <div class="col-12 mb-2">
                    <label for="nome">Nome:</label>
                    <input id="nome" name="nome" type="text" class="form-control" placeholder="Ex: Joseph Antonio Silva">
                </div>
                <div class="col-12 mb-2">
                    <label for="endereco">Endereço:</label>
                    <input id="endereco" name="endereco" type="text" class="form-control" placeholder="Ex: Av. Vitória">
                </div>
                <div class="col-12 mb-2">
                    <label for="telefone">Telefone</label>
                    <input id="telefone" name="telefone" type="text" class="form-control" placeholder="Ex: 27 33992211">
                </div>
                <div class="col-12 mb-2">
                    <label for="celular">Celular</label>
                    <input id="celular" name="celular" type="text" class="form-control" placeholder="Ex: 27 999775500">
                </div>
                <div class="col-12 mb-2">
                    <label for="cpf">CPF:</label>
                    <input id="cpf" name="cpf" type="text" class="form-control" oninput="mascara(this)" placeholder="Ex: 111.222.777-33">
                </div>
                <div class="col-12 d-flex">
                    <div id="save" class="btn-success" onclick="saveAction()">Salvar</div>
                    <div id="cancel" class="btn-fail ml-1" onclick="cancelAction()">Cancelar</div>
                </div>
            </div>
        </form>
    </div>
</div>

<section>
    <div class="container">
        <div class="client-border my-3">
            <h2 id="page-title">
                Meus clientes
            </h2>
        </div>
        <div class="row">
            <div id="addCliente" class="info-btn mb-2 ml-2" onclick="addCliente()">Adicionar Cliente</div>
        </div>
        <div class="row">
            <?php foreach ($clientes as $cliente) : ?>
                <div class="col-4 client-box mb-4" id="<?php echo $cliente['id']; ?>">
                    <div class="row">
                        <div class="col-12">
                            <strong>Nome: </strong>
                            <spam id="nome-<?php echo $cliente['id']; ?>"><?php echo $cliente['nome']; ?></spam>
                        </div>
                        <div class="col-12">
                            <strong>Endreço: </strong>
                            <spam id="endereco-<?php echo $cliente['id']; ?>"><?php echo $cliente['endereco']; ?></spam>
                        </div>
                        <div class="col-12">
                            <strong>Telefone: </strong>
                            <spam id="telefone-<?php echo $cliente['id']; ?>"><?php echo $cliente['telefone']; ?></spam>
                        </div>
                        <div class="col-12">
                            <strong>Celular: </strong>
                            <spam id="celular-<?php echo $cliente['id']; ?>"><?php echo $cliente['celular']; ?></spam>
                        </div>
                        <div class="col-12">
                            <strong>CPF: </strong>
                            <spam id="cpf-<?php echo $cliente['id']; ?>"><?php echo $cliente['cpf']; ?></spam>
                        </div>
                        <div class="col-12 text-right d-flex mt-1">
                            <div id="edit-<?php echo $cliente['id']; ?>" onclick="editCliente(<?php echo $cliente['id']; ?>)"><i class="fas fa-edit"></i></div>
                            <div id="delete-<?php echo $cliente['id']; ?>" onclick="deleteCliente(<?php echo $cliente['id']; ?>)"><i class="fas fa-trash-alt"></i></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<script>
    function addCliente() {
        $("#modal-title").text("Adicionar Cliente");
        $("#form-type").val("create");

        $("#modal-overlay").removeClass("hide");
        $("#modal-overlay").addClass("show");
    }

    function editCliente(id) {
        $("#modal-title").text("Editar Cliente");
        $("#form-type").val("edit");
        $("#id").val(id);
        $("#nome").val($("#nome-" + id).text());
        $("#endereco").val($("#endereco-" + id).text());
        $("#telefone").val($("#telefone-" + id).text());
        $("#celular").val($("#celular-" + id).text());
        $("#cpf").val($("#cpf-" + id).text());

        $("#modal-overlay").removeClass("hide");
        $("#modal-overlay").addClass("show");
    }

    function mascara(i) {
        var v = i.value;
        i.setAttribute("maxlength", "14");
        if (v.length == 3 || v.length == 7) i.value += ".";
        if (v.length == 11) i.value += "-";
    }

    function deleteCliente(id) {
        var endpoint = "<?php echo SITE_URL; ?>/cliente/delete/" + id
        request = $.ajax({
            url: endpoint,
            type: "post",
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            console.log(response);
            if (response == 1) {
                showResponse("Deletado com sucesso!", "S");
            } else {
                showResponse("Erro ao deletar!", "F");
            }
        });

        // Callback handler that will be called on failure
        request.fail(function(jqXHR, textStatus, errorThrown) {
            // Log the error to the console
            console.error(
                "The following error occurred: " +
                textStatus, errorThrown
            );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function() {
            // Reenable the inputs
            // $inputs.prop("disabled", false);
        });
    }

    function cancelAction() {
        $("#modal-title").text("");
        $("#form-type").val("");
        $("#nome").val("");
        $("#endereco").val("");
        $("#telefone").val("");
        $("#celular").val("");
        $("#cpf").val("");

        $("#modal-overlay").removeClass("show");
        $("#modal-overlay").addClass("hide");
    }

    function saveAction() {
        var endpoint = ""
        if ($("#form-type").val() == 'edit') {
            endpoint = "<?php echo SITE_URL; ?>/cliente/edit/" + $("#id").val() + "/" + $("#nome").val() + "/" + $("#endereco").val() + "/" + $("#telefone").val() + "/" + $("#celular").val() + "/" + $("#cpf").val()
        }
        if ($("#form-type").val() == 'create') {
            endpoint = "<?php echo SITE_URL; ?>/cliente/create/" + $("#nome").val() + "/" + $("#endereco").val() + "/" + $("#telefone").val() + "/" + $("#celular").val() + "/" + $("#cpf").val()
        }
        request = $.ajax({
            url: endpoint,
            type: "post",
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            console.log(response);
            if (response == 1) {
                showResponse("Salvo com sucesso!", "S");
            } else {
                showResponse("Erro ao salvar!", "F");
            }
        });

        // Callback handler that will be called on failure
        request.fail(function(jqXHR, textStatus, errorThrown) {
            // Log the error to the console
            console.error(
                "The following error occurred: " +
                textStatus, errorThrown
            );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function() {
            // Reenable the inputs
            // $inputs.prop("disabled", false);
        });
    }

    function showResponse(text, sts) {
        $("#response-txt").text(text);
        if (sts == "S") {
            $("#response-txt").addClass("color-success")
        } else {
            $("#response-txt").addClass("color-fail")
        }
        $("#response-msg").removeClass("hide");
        $("#response-msg").addClass("show");

    }

    function reloadPage() {
        window.location.reload();
    }
</script>

<?php
include(FOOTER);
?>