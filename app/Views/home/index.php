<?php $this->layout(config('view.layout')); ?>

<?php $this->start('page') ?>

<?php $this->insert('home/dashboard'); ?>

<?php $this->stop() ?>

<?php $this->start('js'); ?>

<?php $this->insert('home/script'); ?>

<?php $this->stop() ?>