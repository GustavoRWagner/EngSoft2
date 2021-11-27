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
        <form action="">
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
    <div class="container-fluid">
        <h1 id="page-title">
            Vendas
        </h1>
        <div class="row">
            <table class="table mt-3 mb-3">
                <thead>
                <tr>
                    <th scope="col">Vendedor</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Desconto</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Parcelas</th>
                    <th scope="col">VL Parcela</th>
                    <th scope="col">Pagamento</th>
                    <th scope="col">Data</th>
                    <th scope="col">Opções</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($compras as $compra): ?>
                    <tr>

                        <td>
                            <spam id="vendedor-<?php echo $compra['id']; ?>"><?php echo $compra['vendedor']; ?></spam>
                        </td>
                        <td>
                            <spam id="cliente-<?php echo $compra['id']; ?>"><?php echo $compra['cliente']; ?></spam>
                        </td>
                        <td>
                            <spam id="produto-<?php echo $compra['id']; ?>"><?php echo $compra['produto']; ?></spam>
                        </td>
                        <td>
                            <spam id="qtd-<?php echo $compra['id']; ?>"><?php echo $compra['qtd']; ?></spam>
                        </td>
                        <td>
                            <spam id="valor-<?php echo $compra['id']; ?>"><?php echo $compra['valor']; ?></spam>
                        </td>
                        <td>
                            <spam id="valorDesconto-<?php echo $compra['id']; ?>"><?php echo $compra['valorDesconto']; ?></spam>
                        </td>
                        <td>
                            <spam id="valorTotal-<?php echo $compra['id']; ?>"><?php echo $compra['valorTotal']; ?></spam>
                        </td>
                        <td>
                            <spam id="parcelas-<?php echo $compra['id']; ?>"><?php echo $compra['parcelas']; ?></spam>
                        </td>
                        <td>
                            <spam id="valorParcela-<?php echo $compra['id']; ?>"><?php echo $compra['valorParcela']; ?></spam>
                        </td>
                        <td>
                            <spam id="formaPagamento-<?php echo $compra['id']; ?>">
                                <?php if ($compra['formaPagamento'] == "D") {
                                    echo "Débito";
                                } else {
                                    echo "Crédito";
                                }
                                ?>

                            </spam>
                        </td>
                        <td>
                            <spam id="dtVenda-<?php echo $compra['id']; ?>"><?php echo $compra['dtVenda']; ?></spam>
                        </td>
                        <td>
                            <i id="delete-<?php echo $compra['id']; ?>"
                               onclick="deleteVenda(<?php echo $compra['id']; ?>)" class="fas fa-trash-alt"
                               data-toggle="tooltip" title="Deletar"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function deleteVenda(id) {
        var endpoint = "<?php echo SITE_URL;?>/vendas/delete/" + id
        request = $.ajax({
            url: endpoint,
            type: "post",
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR) {
            console.log(response);
            if (response == 1) {
                showResponse("Deletado com sucesso!", "S");
            } else {
                showResponse("Erro ao deletar!", "F");
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
            endpoint = "<?php echo SITE_URL;?>/vendedor/edit/" + $("#id").val() + "/" + $("#matricula").val() + "/" + $("#nome").val() + "/" + $("#endereco").val() + "/" + $("#telefone").val() + "/" + $("#cpf").val() + "/" + $("#salariobase").val()
        }
        if ($("#form-type").val() == 'create') {
            endpoint = "<?php echo SITE_URL;?>/vendedor/create/" + $("#nome").val() + "/" + $("#endereco").val() + "/" + $("#telefone").val() + "/" + $("#cpf").val() + "/" + $("#salariobase").val()
        }
        console.log(endpoint)
        request = $.ajax({
            url: endpoint,
            type: "post",
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR) {
            console.log(response);
            if (response == 1) {
                showResponse("Salvo com sucesso!", "S");
            } else {
                showResponse("Erro ao salvar!", "F");
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
