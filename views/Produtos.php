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
                    <input id="descricao" name="descricao" type="text" class="form-control" placeholder="Ex: Leite condensado muito gostoso">
                </div>
                <div class="col-12 mb-2">
                    <label for="valor">Valor:</label>
                    <input id="valor" name="valor" type="text" class="form-control" placeholder="Ex: 10,99">
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

            <?php foreach ($produtos as $produto): ?>
                <div class="col-4 client-box mb-4 " id="<?php echo $produto['id'];?>">
                    <div class="row">
                        <div class="col-12 text-right d-flex mt-1">
                            <div id="edit-<?php echo $produto['id'];?>" onclick="editCliente(<?php echo $produto['id']; ?>)"><i class="fas fa-edit"></i></div>
                            <div id="delete-<?php echo $produto['id'];?>" onclick="deleteCliente(<?php echo $produto['id']; ?>)"><i class="fas fa-trash-alt"></i></div>
                        </div>
                        <input id="estoqueMinimo-<?php echo $produto['id']; ?>" type="hidden" value="<?php echo $produto['estoqueMinimo']; ?>">
                        <div class="col-12">
                            <spam id="descricao-<?php echo $produto['id']; ?>"><?php echo $produto['descricao']; ?></spam>
                        </div>
                        <div class="col-12">
                            Qtd:<spam id="qtdEstoque-<?php echo $produto['id']; ?>"><?php echo $produto['qtdEstoque']; ?></spam>
                        </div>
                        <div class="col-12">
                            R$<spam id="valor-<?php echo $produto['id']; ?>"><?php echo $produto['valor']; ?></spam>
                        </div>
                        <div class="col-12">
                            <spam id="validade-<?php echo $produto['id']; ?>"><?php echo $produto['validade']; ?></spam>
                        </div>
                        <div class="col-12 text-right d-flex mt-1">
                            <div id="edit-<?php echo $produto['id'];?>" class="btn-success" onclick="efetuarVenda(<?php echo $produto['id']; ?>)">Efetuar venda</div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<script>
    function addProduto(){
        $("#modal-title").text("Adicionar Produto");
        $("#form-type").val("create");

        $("#modal-overlay").removeClass("hide");
        $("#modal-overlay").addClass("show");
    }

    function editCliente(id){
        $("#modal-title").text("Editar Produto");
        $("#form-type").val("edit");
        $("#id").val(id);
        $("#descricao").val($("#descricao-"+id).text());
        $("#valor").val($("#valor-"+id).text());
        $("#qtdEstoque").val($("#qtdEstoque-"+id).text());
        $("#estoqueMinimo").val($("#estoqueMinimo-"+id).val());
        $("#validade").val($("#validade-"+id).text());

        $("#modal-overlay").removeClass("hide");
        $("#modal-overlay").addClass("show");
    }
    function deleteCliente(id){
        var endpoint = "<?php echo SITE_URL;?>/produto/delete/"+id
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
    function cancelAction(){
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
    function saveAction(){
        var endpoint = ""
        if($("#form-type").val() == 'edit'){
            endpoint = "<?php echo SITE_URL;?>/produto/edit/"+$("#id").val()+"/"+$("#descricao").val()+"/"+$("#valor").val()+"/"+$("#qtdEstoque").val()+"/"+$("#estoqueMinimo").val()+"/"+$("#validade").val()
        }
        if($("#form-type").val() == 'create'){
            endpoint = "<?php echo SITE_URL;?>/produto/create/"+$("#descricao").val()+"/"+$("#valor").val()+"/"+$("#qtdEstoque").val()+"/"+$("#estoqueMinimo").val()+"/"+$("#validade").val()
        }
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

    function showResponse(text, sts){
        $("#response-txt").text(text);
        if(sts == "S"){
            $("#response-txt").addClass("color-success")
        }else{
            $("#response-txt").addClass("color-fail")
        }
        $("#response-msg").removeClass("hide");
        $("#response-msg").addClass("show");

    }
    function reloadPage(){
        window.location.reload();
    }
</script>

<?php
include(FOOTER);
?>
