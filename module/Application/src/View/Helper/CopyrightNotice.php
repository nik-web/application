<?php

/**
 * This file is part of application with Laminas MVC framework
 *
 * @package    Application\View\Helper
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/application
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Application\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Application\ValueObject\Provider;

/**
 * CopyrightNotice class
 * 
 * View helper for setting and retrieving the copyright notice of this application.
 *
 * @package    Application\View\Helper
 * @author     Niklaus Höpfner <editor@nik-web.net>
 */
class CopyrightNotice extends AbstractHelper
{
    /**
     * Render copyright notice
     * 
     * @return string $result copyright notice
     */
    public function render() : string
    {
        if (date('Y') === Provider::YEAR_OF_PUBLICATION) {
            $datePart = date('Y');
        } else {
            $datePart = Provider::YEAR_OF_PUBLICATION . ' - ' . date('Y');
        }
        $result =  '&copy; ' . $datePart . ' ' . Provider::FIRST_NAME . ' '
            . Provider::LAST_NAME;

        return '<small id="copyright-notice">' . $result . '</small>';
    }
}
