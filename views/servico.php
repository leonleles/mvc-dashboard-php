<form action="" method="POST">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Nome:</label>
            <input type="text" class="form-control" id="inputEmail4" placeholder="Nome do Cliente" name="nome">
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Telefone:</label>
            <input type="text" class="form-control" id="inputPassword4" placeholder="Ex.: (00) 00000-0000" name="telefone">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputAddress">Endereço:</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="Ex.: Rua 03, N° 489  " name="endereco">
        </div>
        <div class="form-group col-md-6">
            <label for="inputState">Localidade:</label>
            <select id="inputState" class="form-control" name="localidade">
                <option></option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputState">Tipo de Serviço:</label>
            <select id="inputState" class="form-control" name="tipo">
                <option></option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress">Horário de Agendamento:</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="" name="agendamento">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputState">Técnico:</label>
            <select id="inputState" class="form-control" name="tecnico">
                <option></option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="inputState">Descrição:</label>
            <textarea class="form-control" rows="1" id="comment" name="descricao"></textarea>
        </div>
    </div>
    <div class="form-row">
        <button type="submit" class="btn btn-primary">Finalizar</button>
    </div>
</form>
