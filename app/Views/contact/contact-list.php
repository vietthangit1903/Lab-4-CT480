<?php $this->layout(config('view.layout')) ?>

<?php $this->start('page') ?>
<div class="section px-3">
    <div class="containter">
        <div class="row">
            <div class="col-12">
                <h3>List of Contact</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="contact-list list">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Address</th>
                                <th scope="col">Ward</th>
                                <th scope="col">District</th>
                                <th scope="col">City</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $start = ($paginator->currentPage() - 1) * $paginator->perPage() + 1; ?>
                            <?php foreach ($contacts as $contact) : ?>
                                <tr>
                                    <th scope="row"><?= $start++; ?></th>
                                    <td><?= $contact->id; ?></td>
                                    <td><?= $contact->address; ?></td>
                                    <td><?= $contact->ward->id . ' - ' . $contact->ward->name; ?></td>
                                    <td><?= $contact->ward->district->id . ' - ' . $contact->ward->district->name; ?></td>
                                    <td><?= $contact->ward->district->city->id . ' - ' . $contact->ward->district->city->name; ?></td>
                                    <td><?= $contact->created_at; ?></td>
                                    <td>
                                        <a class="remove-item delete-contact" href="<?= request()->baseUrl(); ?>/contact_list/delete" data-id="<?= $contact->id; ?>" title="Delete <?= $contact->id; ?>" data-name="<?= $contact->id; ?>" data-return-url="<?= request()->fullUrl(); ?>">
                                            <i class="lni lni-close"></i>
                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Hiển thị phân trang bên dưới bảng -->
                <div class="pagination">
                    <?= $this->insert('partials/pagination', ['paginator' => $paginator]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->stop(); ?>

<?php $this->start('js') ?>
<?= $this->insert('contact/contact-list-script') ?>
<?php $this->stop() ?>