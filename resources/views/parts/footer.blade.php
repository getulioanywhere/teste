<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>  
        Desenvolvido por
        <a href="">
             Getulio Turelli de Melo
        </a>
        <?php echo date('Y') ?>
    </strong>
    
    <div class="float-right d-none d-sm-inline-block">
        <b>Sistema</b> 2.0&nbsp;
        <b>Laravel:</b> v{{ Illuminate\Foundation\Application::VERSION }} &nbsp;
        <b>PHP:</b> v{{ PHP_VERSION }}&nbsp;
        <b>Região logado: </b>
        {{ config('app.locale') }} /
        {{ config('app.timezone') }}
    </div>
</footer>


<aside class="control-sidebar control-sidebar-dark">
    
</aside>
       