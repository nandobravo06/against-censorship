<form class="col-12" enctype="multipart/form-data" action="{{url}}postagem/publicar_postagem" method="POST">
    <legend>Em que você acredita?</legend>
    <div class="row">
        <input type="textarea" name="publicacao" class="form-control publicacao" rows="5">
        
        <input type="file" id="imagem" name="imagem[]"  multiple="multiple" accept="image/*" alt="Selecione imagens">

        <div id="dvPreview">
        </div>
        
        <input type="submit" name="publicar" value="publicar" class="form-control">
        
    </div>

</form>