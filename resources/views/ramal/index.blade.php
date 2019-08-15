@extends('layouts.app')

@section('content')

<style>
#BtnApagar:hover{
    color:#212529
}


</style>

<?php  
    $ipAcessado = $_SERVER['SERVER_PORT']; 
?>

<div class="container-fluid theme-showcase" role="main">
    <!--TITULO LISTAR Ramais-->
    <div class="page-header">
        <h1 style="text-align: center;">Ramais</h1>		
    </div>
    <!--Pesquisar ramais por nome-->
    <div class="row" style="display: inherit; margin-top: 40px">
        <div class="col-12">
            <form action="{{ route('ramal.pesquisar')}}" method="GET" id='formPesquisa' style="text-align:center">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <input type="text" class='h-30' id='InputNome' name="nome" placeholder="Digite um nome para pesquisar" style="">
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <input type="text" class='h-30' id='InputDepartamento' name="departamento" class='depInput' placeholder="Digite um departamento para pesquisar" style="">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                    <button type='submit'id='BtnPesquisa' class="btn btn-xs btn-dark b-r-50 float-l"> Pesquisar</button>
                    </div>
                </div>				 
            </form>
        </div>
	</div>

    <!--Tabela listar ramais-->
    <div class="row" id="tabela_listar_orcamento" STYLE="display: inherit;">
        <div class="col-md-12 table-responsive shadow p-3 mb-5 bg-white rounded">
            <table class="table table-hover">
                <thead class="">
                <tr>
                    <th style=font-weight:bold>Nome</th>
                    <th style=font-weight:bold>Ramal</th>
					<th style=font-weight:bold>Departamento</th>
					<th style=font-weight:bold>E-mail</th>
					<th style=font-weight:bold>Celular</th>
                    <th style=font-weight:bold>Ação</th>         
                    @if($ipAcessado != '888')           
                    <th><button type=button class='btn btn-xs btn-success b-r-50' data-toggle=modal data-target='#myModalcad' style='margin: 0px 6px 0px'>Cadastrar</button></th>
                    @endif
                </tr>
                </thead>

                <tbody>
                    @foreach($registro as $array)
                    <tr>
                        <td> <?php echo $array->nome; ?> </td>
                        <td> <?php echo $array->ramal; ?> </td>
                        <td> <?php echo $array->departamento; ?> </td>
                        <td> <?php echo $array->email; ?> </td>
                        <td> <?php echo $array->corporativo; ?> </td>
                        @if($ipAcessado != '888')
                        <td colspan='2'>
                            <button type=button class='btn btn-xs btn-warning b-r-50 white' data-toggle=modal data-target='#exampleModal' data-whatever="<?php echo $array->id  ?>" data-whatevernome="<?php echo $array->nome ?>" data-whateverdepartamento="<?php echo $array->departamento ?>" data-whateverramal="<?php echo $array->ramal ?>" data-whateveremail="<?php echo $array->email ?>" data-whatevercorporativo="<?php echo $array->corporativo?>" >Editar</button>
                            <button id="BtnApagar" type=button class='btn btn-xs btn-danger b-r-50' style='margin-left: 5px'> <a href="{{ route('ramal.apagar', $array->id) }}" style='color: inherit;text-decoration:none'>Apagar </a></button>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div align="center">
                {!! $registro->links() !!}            
            </div>
        </div>
    </div>    
</div>

<!-- Inicio Modal CADASTRAR -->
<div class="modal fade" id="myModalcad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius:15px">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Cadastrar Ramal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="font-size:34px">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('ramal.cadastrar') }}" enctype="multipart/form-data" style="font-size: 13px;">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nome:</label>
                        <input name='nome' type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-departamento" class="control-label">Departamento:</label>
                        <input name="departamento" type="text" class="form-control" maxlength="40" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-ramal" class="control-label">Ramal:</label>
                        <input name="ramal" type="text" class="form-control" maxlength="9" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-email" class="control-label">Email:</label>
                        <input name="email" type="email" class="form-control" maxlength="71">
                    </div>
                    <div class="form-group">
                        <label for="recipient-corporativo" class="control-label">Celular:</label>
                        <input name="corporativo" type="text" class="form-control" >
                    </div>                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal -->

<!--INICIO MODAL EDITAR-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style='border-radius:15px;'>
            <div class="modal-header">
                <input type="text" class="form-control m-l-35" id='TituloEditar' style='border:none;font-size: 22px;font-weight:bold;text-align:center' readonly>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="font-size:34px">&times;</span></button>
            </div>
            <div class="modal-body" style="background: linear-gradient(-135deg, #827f7f, white);border-radius:15px">
                <form method="POST" action="{{ route('ramal.editar') }}">
                    {{ csrf_field() }}
                    <div class="form-group" style='display:inherit'>
                        <label for="recipient-name" class="control-label">Nome:</label>
                        <input name='nome' type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-departamento" class="control-label">Departamento:</label>
                        <input name="departamento" type="text" class="form-control" id="recipient-departamento">
                    </div>
                    <div class="form-group">
                        <label for="recipient-ramal" class="control-label">Ramal:</label>
                        <input name="ramal" type="text" class="form-control" id="recipient-ramal">
                    </div>
                    <div class="form-group">
                        <label for="recipient-email" class="control-label">E-mail:</label>
                        <input name="email" type="email" class="form-control" id="recipient-email">
                    </div>  

                    <input name="id" type="hidden" class="form-control" id="id" value="">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Alterar</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!--FIM MODAL EDITAR-->

@endsection
