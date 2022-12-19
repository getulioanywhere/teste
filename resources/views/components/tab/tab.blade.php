<section class="content">
    <div class="container-fluid">     

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    @lang($titlestr)
                </h3>
            </div>

            <div class="card-body">
                <h4>{{$namestr}}</h4>

                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                    {{$nav}}
                </ul>

                <div class="tab-content" id="custom-content-below-tabContent">

                    {{$content}}

                </div>
            </div>



        </div>
    </div>
</section>