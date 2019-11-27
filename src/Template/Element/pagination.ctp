<nav aria-label="Page navigation">
    <ul class="pagination pagination-sm">
        <?php

        $this->Paginator->templates([
            'first' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'last' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'current' => '<li class="page-item active"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'ellipsis' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">...</a></li>'
        ]);

        $this->Paginator->templates([
            'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        ?>

        <?php echo $this->Paginator->first('Primeira'); ?>
        <?php echo $this->Paginator->prev('Voltar'); ?>
        <?php echo $this->Paginator->numbers(['last' => 1]); ?>
        <?php echo $this->Paginator->next('Próxima'); ?>
        <?php echo $this->Paginator->last('Última'); ?>
        <p><?= $this->Paginator->counter(['format' => __('Pagina {{page}} de {{pages}}, mostrando {{current}} registro(s) de um total de {{count}}')]) ?></p>

    </ul>
</nav>
