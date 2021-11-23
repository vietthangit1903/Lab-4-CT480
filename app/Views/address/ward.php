<?php $this->layout(config('view.layout')) ?>

<?php $this->start('page') ?>
<div class="section">
    <div class="containter">
        <div class="row">
            <div class="col-12">
                <h3>List of Ward and Communes</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php $this->insert('address/ward-list', [
                    'items' => $items,
                    'paginator' => $paginator
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
<?php $this->stop(); ?>

<?php $this->start('js') ?>
 <?= $this->insert('address/ward-script') ?>
 <?php $this->stop(); ?>