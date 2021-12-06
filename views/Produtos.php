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
                <div class="col-12 mb-2">
                    <label for="descricao">Descrição:</label>
                    <input id="descricao" name="descricao" type="text" class="form-control" placeholder="Ex: Ração vegana com frutas">
                </div>
                <div class="col-12 mb-2">
                    <label for="valor">Valor:</label>
                    <input id="valor" name="valor" type="number" step=".01" class="form-control" placeholder="Ex: 40,99">
                </div>
                <div class="col-12 mb-2">
                    <label for="qtdEstoque">Quantidade em Estoque</label>
                    <input id="qtdEstoque" name="qtdEstoque" type="text" class="form-control" placeholder="Ex: 10">
                </div>
                <div class="col-12 mb-2">
                    <label for="estoqueMinimo">Estoque minimo</label>
                    <input id="estoqueMinimo" name="estoqueMinimo" type="text" class="form-control" placeholder="Ex: 5">
                </div>
                <div class="col-12 mb-2">
                    <label for="validade">Validade</label>
                    <input id="validade" name="validade" type="text" class="form-control" placeholder="Ex: 11/11/2025">
                </div>
                <div class="col-12 d-flex">
                    <div id="save" class="btn-success" onclick="saveAction()">Salvar</div>
                    <div id="cancel" class="btn-fail" onclick="cancelAction()">Cancelar</div>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="modal-overlay-venda" class="modal-overlay hide">
    <div class="modal-box">
        <h1 id="modal-title"></h1>
        <form action="">
            <div class="row">
                <input id="form-type" type="hidden" value="">
                <input id="id-venda" type="hidden" value="">
                <div class="col-12 mb-2">
                    <label for="descricao-venda">Produto:</label>
                    <input id="descricao-venda" name="descricao-venda" type="text" class="form-control" disabled>
                </div>
                <div class="col-6 mb-2">
                    <label for="valor-venda">Valor Unitário:</label>
                    <input id="valor-venda" name="valor-venda" type="text" class="form-control" disabled>
                </div>
                <div class="col-6 mb-2">
                    <label for="qtd">Qtd (<span id="emEstoque"></span> Em estoque):</label>
                    <input id="qtd" name="qtd" type="number" class="form-control" onchange="calcSubtotal()">
                </div>
                <div class="col-6 mb-2">
                    <label for="desconto"><span class="float-left">Desconto:</span>
                        <div class="float-left ml-1"><i class="fas fa-calculator" data-toggle="tooltip" title="Calcular desconto" onclick="calcDesconto()"></i>
                        </div>
                    </label>
                    <input id="desconto" name="desconto" type="text" class="form-control" onchange="calcSubtotal()">
                </div>
                <div class="col-6 mb-2">
                    <label for="subtotal">Subtotal:</label>
                    <input id="subtotal" name="subtotal" type="text" class="form-control" disabled>
                </div>
                <div class="col-12 mb-2">
                    <select id="formaPagamento" class="form-select form-control" onchange="verifyPayment()">
                        <option selected>Forma de pagamento</option>
                        <option value="C">Credito</option>
                        <option value="D">Debito</option>
                    </select>
                </div>
                <div id="qtdParcelasField" class="col-6 mb-2 hide">
                    <label for="qtdParcelas">Parcelas:</label>
                    <input id="qtdParcelas" name="qtdParcelas" type="number" class="form-control" min="1" max="1" onchange="calcVlParcela()">
                </div>
                <div id="vlParcelaField" class="col-6 mb-2 hide">
                    <label for="vlParcela">Valor da parcela:</label>
                    <input id="vlParcela" name="vlParcela" type="text" class="form-control">
                </div>
                <div class="col-6 mb-2">
                    <select id="vendedor" class="form-select form-control" onchange="verifyPayment()">
                        <option selected>Selecione Vendedor</option>
                        <?php foreach ($vendedores as $vendedor) : ?>
                            <option value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nome']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <select id="cliente" class="form-select form-control" onchange="verifyPayment()">
                        <option selected>Selecione Cliente</option>
                        <?php foreach ($clientes as $cliente) : ?>
                            <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nome']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 d-flex">
                    <div id="save" class="btn-success" onclick="concluirVenda()">Concluir venda</div>
                    <div id="cancel" class="btn-fail" onclick="cancelVenda()">Cancelar</div>
                </div>
            </div>
        </form>
    </div>
</div>
<section>
    <div class="container">
        <div class="client-border my-3">
            <h2 id="page-title">
                Produtos
            </h2>
        </div>
        <div class="row">
            <div id="addProduto" class="info-btn" onclick="addProduto()">Adicionar Produto</div>
        </div>
        <div class="row">

            <?php foreach ($produtos as $produto) : ?>
                <div class="col-xl-4 col-md-6 client-box mt-4 " id="<?php echo $produto['id']; ?>">
                    <div class="row">
                        <div class="col-12 text-right d-flex mt-1">
                            <div id="edit-<?php echo $produto['id']; ?>" onclick="editProduto(<?php echo $produto['id']; ?>)"><i class="fas fa-edit"></i>
                            </div>
                            <div id="delete-<?php echo $produto['id']; ?>" onclick="deleteProduto(<?php echo $produto['id']; ?>)"><i class="fas fa-trash-alt"></i></div>
                        </div>
                        <div>
                            <img src="../public/img/Imagempadrao.jpg" alt="imagem da ração">
                        </div>
                        <input id="estoqueMinimo-<?php echo $produto['id']; ?>" type="hidden" value="<?php echo $produto['estoqueMinimo']; ?>">
                        <div class="col-12">
                            <spam id="descricao-<?php echo $produto['id']; ?>"><?php echo $produto['descricao']; ?></spam>
                        </div>
                        <div class="col-12">
                            Qtd:
                            <spam <?php if ($produto['qtdEstoque'] <= $produto['estoqueMinimo']) {
                                        echo "class='text-red'";
                                    } ?> id="qtdEstoque-<?php echo $produto['id']; ?>"><?php echo $produto['qtdEstoque']; ?></spam>
                        </div>
                        <div class="col-12">
                            R$
                            <spam id="valor-<?php echo $produto['id']; ?>"><?php echo $produto['valor']; ?></spam>
                        </div>
                        <div class="col-12">
                            <spam id="validade-<?php echo $produto['id']; ?>"><?php echo $produto['validade']; ?></spam>
                        </div>
                        <div class="col-12 text-right d-flex mt-1">
                            <div id="edit-<?php echo $produto['id']; ?>" class="btn-success" onclick="efetuarVenda(<?php echo $produto['id']; ?>)">Efetuar venda
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<script>
    function calcVlParcela() {
        let subtotal = $("#subtotal").val();
        let parcelas = $("#qtdParcelas").val();
        let valorParcela = subtotal / parcelas;
        valorParcela.toFixed(2);
        $("#vlParcela").val(valorParcela);
    }

    function calcDesconto() {
        var endpoint = "<?php echo SITE_URL; ?>/vendas/calcDesconto/" + $("#subtotal").val();
        console.log(endpoint);
        request = $.ajax({
            url: endpoint,
            type: "post",
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            console.log(response);
            $("#desconto").val(response);
            calcSubtotal();
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

    function concluirVenda() {
        let vlTotal = $("#valor-venda").val().replace(".", ",")
        let vlDesconto = $("#desconto").val().replace(".", ",")
        let subtotal = $("#subtotal").val().replace(".", ",")
        let vlparcela = $("#vlParcela").val().replace(".", ",")
        if ($("#formaPagamento").val() == "C") {
            var endpoint = "<?php echo SITE_URL; ?>/vendas/create/" + $("#vendedor").val() + "/" + $("#cliente").val() + "/" + $("#id-venda").val() + "/" + $("#qtd").val() + "/" + vlTotal + "/" + vlDesconto + "/" + subtotal + "/" + $("#qtdParcelas").val() + "/" + vlparcela + "/" + $("#formaPagamento").val()
        } else {
            var endpoint = "<?php echo SITE_URL; ?>/vendas/create/" + $("#vendedor").val() + "/" + $("#cliente").val() + "/" + $("#id-venda").val() + "/" + $("#qtd").val() + "/" + vlTotal + "/" + vlDesconto + "/" + subtotal + "/" + $("#formaPagamento").val()
        }

        console.log(endpoint);
        request = $.ajax({
            url: endpoint,
            type: "post",
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            console.log(response);
            showResponse("Venda efetuada com sucesso!", "S");

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

    function calcSubtotal() {
        let valUnit = $("#valor-venda").val();
        let qtd = $("#qtd").val();
        let desconto = $("#desconto").val();
        let total = valUnit * qtd - desconto;
        $("#subtotal").val(total.toFixed(2));
        if (total >= 500) {
            $("#qtdParcelas").attr("max", 3)
        } else {
            $("#qtdParcelas").attr("max", 1)
        }

    }

    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function cancelVenda() {
        $("#id-venda").val("");
        $("#descricao-venda").val("");
        $("#valor-venda").val("");
        $("#emEstoque").text("");
        $("#qtd").val("");
        $("#desconto").val("");
        $("#subtotal").val("");

        $("#modal-overlay-venda").removeClass("show");
        $("#modal-overlay-venda").addClass("hide");
    }

    function efetuarVenda(id) {
        $("#id-venda").val(id);
        $("#descricao-venda").val($("#descricao-" + id).text());
        $("#valor-venda").val($("#valor-" + id).text());
        $("#emEstoque").text($("#qtdEstoque-" + id).text());
        $("#qtd").val(1);
        $("#desconto").val("0.00");
        $("#subtotal").val($("#valor-" + id).text());

        $("#modal-overlay-venda").removeClass("hide");
        $("#modal-overlay-venda").addClass("show");
    }

    function verifyPayment() {
        let paymentType = $('#formaPagamento').val();
        if (paymentType == "C") {
            $("#qtdParcelasField").removeClass("hide");
            $("#vlParcelaField").removeClass("hide");
        } else {
            $("#qtdParcelasField").addClass("hide");
            $("#vlParcelaField").addClass("hide");
        }
    }

    function addProduto() {
        $("#modal-title").text("Adicionar Produto");
        $("#form-type").val("create");

        $("#modal-overlay").removeClass("hide");
        $("#modal-overlay").addClass("show");
    }

    function editProduto(id) {
        $("#modal-title").text("Editar Produto");
        $("#form-type").val("edit");
        $("#id").val(id);
        $("#descricao").val($("#descricao-" + id).text());
        $("#valor").val($("#valor-" + id).text());
        $("#qtdEstoque").val($("#qtdEstoque-" + id).text());
        $("#estoqueMinimo").val($("#estoqueMinimo-" + id).val());
        $("#validade").val($("#validade-" + id).text());

        $("#modal-overlay").removeClass("hide");
        $("#modal-overlay").addClass("show");
    }

    function deleteProduto(id) {
        var endpoint = "<?php echo SITE_URL; ?>/produto/delete/" + id
        request = $.ajax({
            url: endpoint,
            type: "post",
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            console.log(response);
            if (response == 1) {
                showResponse("Deletado com sucesso!", "S");
            } else if (response == 204) {
                showResponse("Esse produto possui compras atreladas. não é possivel deletar!", "F");
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
        let valor = $("#valor").val().replace(".", ",")
        if ($("#form-type").val() == 'edit') {
            endpoint = "<?php echo SITE_URL; ?>/produto/edit/" + $("#id").val() + "/" + $("#descricao").val() + "/" + valor + "/" + $("#qtdEstoque").val() + "/" + $("#estoqueMinimo").val() + "/" + $("#validade").val()
        }
        if ($("#form-type").val() == 'create') {
            endpoint = "<?php echo SITE_URL; ?>/produto/create/" + $("#descricao").val() + "/" + valor + "/" + $("#qtdEstoque").val() + "/" + $("#estoqueMinimo").val() + "/" + $("#validade").val()
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
            console.log(
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