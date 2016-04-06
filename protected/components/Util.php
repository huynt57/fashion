<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Util {

    public static function time_elapsed_string($ptime) {
        $etime = time() - $ptime;

        if ($etime < 1) {
            return '0 giây';
        }

        $a = array(365 * 24 * 60 * 60 => 'năm',
            30 * 24 * 60 * 60 => 'tháng',
            24 * 60 * 60 => 'ngày',
            60 * 60 => 'giờ',
            60 => 'phút',
            1 => 'giây'
        );
        $a_plural = array('năm' => 'năm',
            'tháng' => 'tháng',
            'ngày' => 'ngày',
            'giờ' => 'giờ',
            'phút' => 'phút',
            'giây' => 'giây'
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' trước';
            }
        }
    }

    public static function getCategoryByUser($user_id) {
        $albums = Albums::model()->findAllByAttributes(array('user_id' => $user_id));
        return $albums;
    }

    public static function getTypeNotificationHtml($type) {
        $html = null;
        switch ($type) {
            case 'like':
                $html = '<span class="icon"><i class="fa fa-heart notifi-like"></i></span>';
                break;
            case 'follow_user':
                $html = '<span class="icon"><i class="fa fa-picture-o notifi-following-post"></i></span>';
                break;
            case 'follow_celeb':
                $html = '<span class="icon"><i class="fa fa-picture-o notifi-following-post"></i></span>';
                break;
            case 'comment_also':
                $html = '<span class="icon"><i class="fa fa-comment notifi-comment"></i></span>';
                break;
            case 'comment':
                $html = '<span class="icon"><i class="fa fa-comment notifi-comment"></i></span>';
                break;
            case 'follow':
                $html = '<span class="icon"><i class="fa fa-user-plus notifi-follower-add"></i></span>';
                break;
            default:
                break;
        }
        return $html;
    }

    public static function generateRandomPointInRange($min, $max) {
        return mt_rand($min, $max);
    }

}
