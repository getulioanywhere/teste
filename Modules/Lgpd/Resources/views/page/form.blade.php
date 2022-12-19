@component('velho.components.form.section', [
    'title' => 'Página',
    'description' => 'política de privacidade.',
])
    <div class="row">
        <div class="col-md-4">
            @include('velho.components.form.text', [
                'model' => $model,
                'name' => 'title',
                'label' => 'Título',
                'autofocus' => true
            ])
        </div>

        <div class="col-md-4">
            @include('velho.components.form.switch', [
                'model' => $model,
                'name' => 'active',
                'checked' => true,
                'label' => 'Active'
            ])    
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            @include('velho.components.form.text', [
                'model' => $model,
                'name' => 'slug',
                'label' => 'Slug'
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @include('velho.components.form.textarea', [
                'model' => $model,
                'name' => 'body',
                'label' => 'Conteudo'
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {{-- @dd($seo) --}}
            @include('velho.components.form.text', [
                'model' => $seo,
                'name' => 'title',
                'belongs' => 'seo',
                'label' => 'title',
                'required' => false
            ])
        </div>
        <div class="col-md-4">
            @include('velho.components.form.text', [
                'model' => $seo,
                'name' => 'keywords',
                'belongs' => 'seo',
                'label' => 'keywords',
                'required' => false
            ])
        </div>
        <div class="col-md-6">
            @include('velho.components.form.textarea', [
                'model' => $seo,
                'name' => 'description',
                'belongs' => 'seo',
                'label' => 'description',
                'required' => false
            ])
        </div>
    </div>
@endcomponent