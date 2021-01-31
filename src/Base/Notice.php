<?php

namespace UkraineAddresses\Base;

class Notice
{
    const SUCCESS = 'notice-success';
    const ERROR = 'notice-error';
    const WARNING = 'notice-warning';
    const INFO = 'notice-info';

    /**
     * Notice constructor.
     */
    public function __construct()
    {
        add_action('admin_notices', [$this, 'renderNotice'], 10, 2);
    }

    /**
     * @param string $message
     * @param string $type
     */
    public function renderNotice($message = '', $type = '')
    {
        ?>
        <div class="notice <?= $type ?>">
            <p><?= $message ?></p>
        </div>
        <?php
    }

    /**
     * @param $message
     */
    public function success($message)
    {
        $this->renderNotice($message, self::SUCCESS);
    }

    /**
     * @param $message
     */
    public function error($message)
    {
        $this->renderNotice($message, self::ERROR);
    }

    /**
     * @param $message
     */
    public function warning($message)
    {
        $this->renderNotice($message, self::WARNING);
    }

    /**
     * @param $message
     */
    public function info($message)
    {
        $this->renderNotice($message, self::INFO);
    }
}