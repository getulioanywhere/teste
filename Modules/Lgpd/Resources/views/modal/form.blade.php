@component('velho.components.form.section', [
    'title' => 'Cookie',
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

        <div class="col-md-8">
            @include('velho.components.form.textarea', [
                'model' => $model,
                'name' => 'body',
                'label' => 'Descrição'
            ])
        </div>
    </div>
@endcomponent