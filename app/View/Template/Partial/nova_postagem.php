<form class="col-12" enctype="multipart/form-data" action="{{url}}postagem/publicar_postagem" method="POST">
    <legend><h1>Em que você acredita?</h1></legend>
    <div class="row">
        <input type="textarea" name="publicacao" class="publicacao" rows="5" cols="50" wrap>
        
        <input type="file" id="imagem" name="imagem[]"  multiple="multiple" accept="image/*" alt="Selecione imagens">

        <div id="dvPreview">
        </div>
        
        <input type="submit" name="publicar" value="publicar" class="form-control">
        
    </div>

</form>