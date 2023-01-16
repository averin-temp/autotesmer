<?php
/**
 * @var $caption
 * @var $services
 * @var $price
 * @var $buy_link
 */

?>
<div>
    <div class="col-md-five_header">
        <table>
            <tbody>
            <tr>
                <td><?= $caption ?></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="col-md-five_body">
        <ul>
            <?php foreach($services as $name): ?>
                <li>
                    <div class="lk_expert_body_packejes_p_body">
                        <div class="lk_expert_body_packejes_p_body_top">
                            <?= $name ?>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>

            <li>
                <div class="lk_expert_body_packejes_p_body">
                    <div class="lk_expert_body_packejes_p_body_mid">
                        <?= $price ?>
                    </div>
                    <div class="lk_expert_body_packejes_p_body_bot">
                        <a class="button button_orange button_top_img" href="<?= $buy_link ?>">купить</a>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</div>
