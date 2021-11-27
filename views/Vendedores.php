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
                <div id="matricula-field" class="col-12 mb-2">
                    <label for="matricula">Matricula:</label>
                    <input id="matricula" name="matricula" type="text" class="form-control" disabled>
                </div>
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
                    <label for="cpf">CPF:</label>
                    <input id="cpf" name="cpf" type="text" class="form-control">
                </div>
                <div class="col-12 mb-2">
                    <label for="salariobase">Salario Base</label>
                    <input id="salariobase" name="salariobase" type="text" class="form-control">
                </div>
                <div class="col-12 d-flex">
                    <div id="save" class="btn-success" onclick="saveAction()">Salvar</div>
                    <div id="cancel" class="btn-fail" onclick="cancelAction()">Cancelar</div>
                </div>
            </div>
        </form>
    </div>
</div>

<section>
    <div class="container">
        <h1 id="page-title">
            Vendedores
        </h1>
        <div class="row">
            <div id="addCliente" class="info-btn" onclick="addVendedor()">Adicionar Vendedor</div>
        </div>
        <div class="row">
            <table class="table mt-3 mb-3">
                <thead>
                    <tr>
                        <th scope="col">Matricula</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Endreço</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Salario Base</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vendedores as $vendedor) : ?>
                        <tr>
                            <th id="<?php echo $vendedor['id']; ?>" scope="row">
                                <spam id="matricula-<?php echo $vendedor['id']; ?>"><?php echo $vendedor['matricula']; ?></spam>
                            </th>
                            <td>
                                <spam id="nome-<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nome']; ?></spam>
                            </td>
                            <td>
                                <spam id="endereco-<?php echo $vendedor['id']; ?>"><?php echo $vendedor['endereco']; ?></spam>
                            </td>
                            <td>
                                <spam id="telefone-<?php echo $vendedor['id']; ?>"><?php echo $vendedor['telefone']; ?></spam>
                            </td>
                            <td>
                                <spam id="cpf-<?php echo $vendedor['id']; ?>"><?php echo $vendedor['cpf']; ?></spam>
                            </td>
                            <td>
                                <spam id="salario-<?php echo $vendedor['id']; ?>"><?php echo number_format(
                                                                                        (float)str_replace(",", ".", str_replace(".", "", $vendedor['salarioBase'])),
                                                                                        2,
                                                                                        ",",
                                                                                        "."
                                                                                    ); ?>
                                </spam>
                            </td>
                            <td>
                                <i id="edit-<?php echo $vendedor['id']; ?>" onclick="editVendedor(<?php echo $vendedor['id']; ?>)" class="fas fa-edit" data-toggle="tooltip" title="Editar"></i>
                                <i id="delete-<?php echo $vendedor['id']; ?>" onclick="deleteVendedor(<?php echo $vendedor['id']; ?>)" class="fas fa-trash-alt" data-toggle="tooltip" title="Deletar"></i>
                                <i id="delete-<?php echo $vendedor['id']; ?>" onclick="calcSalarioVendedor(<?php echo $vendedor['id']; ?>)" class="fas fa-comment-dollar" data-toggle="tooltip" title="Calcular salario"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function addVendedor() {
        $("#modal-title").text("Adicionar Vendedor");
        $("#form-type").val("create");

        $("#matricula-field").addClass("hide");
        $("#matricula-field").removeClass("show");

        $("#modal-overlay").removeClass("hide");
        $("#modal-overlay").addClass("show");
    }

    function editVendedor(id) {

        $("#matricula-field").addClass("show");
        $("#matricula-field").removeClass("hide");

        $("#modal-title").text("Editar Vendedor");
        $("#form-type").val("edit");
        $("#id").val(id);
        $("#matricula").val($("#matricula-" + id).text())
        $("#nome").val($("#nome-" + id).text());
        $("#endereco").val($("#endereco-" + id).text());
        $("#telefone").val($("#telefone-" + id).text());
        $("#celular").val($("#celular-" + id).text());
        $("#cpf").val($("#cpf-" + id).text());
        $("#salariobase").val($("#salario-" + id).text());

        $("#modal-overlay").removeClass("hide");
        $("#modal-overlay").addClass("show");
    }

    function deleteVendedor(id) {
        var endpoint = "<?php echo SITE_URL; ?>/vendedor/delete/" + id
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
        $("#matricula").val("");
        $("#nome").val("");
        $("#endereco").val("");
        $("#telefone").val("");
        $("#cpf").val("");
        $("#salariobase").val("");

        $("#modal-overlay").removeClass("show");
        $("#modal-overlay").addClass("hide");
    }

    function saveAction() {
        var endpoint = ""
        // let salariobase = parseFloat($("#salariobase").val().replace('.', '').replace(',', '.'))
        // console.log(salariobase)
        if ($("#form-type").val() == 'edit') {
            endpoint = "<?php echo SITE_URL; ?>/vendedor/edit/" + $("#id").val() + "/" + $("#matricula").val() + "/" + $("#nome").val() + "/" + $("#endereco").val() + "/" + $("#telefone").val() + "/" + $("#cpf").val() + "/" + $("#salariobase").val()
        }
        if ($("#form-type").val() == 'create') {
            endpoint = "<?php echo SITE_URL; ?>/vendedor/create/" + $("#nome").val() + "/" + $("#endereco").val() + "/" + $("#telefone").val() + "/" + $("#cpf").val() + "/" + $("#salariobase").val()
        }
        console.log(endpoint)
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

    function calcSalarioVendedor(id) {

    }
</script>

<?php
include(FOOTER);
?>