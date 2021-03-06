<?php

namespace Kanboard\Plugin\Customizer\Helper;

use Kanboard\Helper\AvatarHelper;
use Kanboard\Core\Base;
/**
 * Avatar Helper
 *
 * @package helper
 * @author  Craig Crosby
 */
class DynamicAvatar extends AvatarHelper
{
    
    public function dynamicRender($user_id, $username, $name, $email, $avatar_path, $css = 'avatar-left', $size = 48)
    {
        if (empty($user_id) && empty($username)) {
            $html = $this->avatarManager->renderDefault($size);
        } else {
            $html = $this->avatarManager->render($user_id, $username, $name, $email, $avatar_path, $size);
        }
        return '<div id="'.$css.'" class="avatar avatar-dyn '.$css.'">'.$html.'</div>';
    }

    public function dynamic($user_id, $username, $name, $email, $avatar_path, $css = '', $size)
    {
        return $this->dynamicRender($user_id, $username, $name, $email, $avatar_path, $css, $size);
    }

    public function currentUserDynamic($css = '')
    {
        $user = $this->userSession->getAll();
        return $this->dynamic($user['id'], $user['username'], $user['name'], $user['email'], $user['avatar_path'], $css, $this->configModel->get('av_size', '20'));
    }
    
    
 }
