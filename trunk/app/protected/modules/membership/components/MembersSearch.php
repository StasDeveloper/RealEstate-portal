<?php
class MembersSearch{
    
    public function findMembers(array $post){
        $result = array();

        $page = $this->getPage($post);
        $limit = $this->getLimit($post);
        $offset = $this->getOffset($page, $limit);

        $conditions = $this->composeConditions($post);
        $result['limit'] = $limit;
        $result['totalCount'] = $totalCount = $this->countUsers($conditions);
        $result['pagesCount'] = $pagesCount = ceil($totalCount / $limit);
        $result['currentPage'] = $currentPage = ($page == 0) ? 1 : $page;

        $result['members'] = Yii::app()->db->createCommand(array(
            'select' => array('t1.id', 't1.username', 't2.user_profile_id', 't2.payment_type', 't2.membership_expire_date'),
            'from'   => 'tbl_users t1, tbl_users_profiles t2',
            'where'  => ($conditions),
            'order'  => 't1.id ASC',
            'offset' => $offset,
            'limit'  => $limit
        ))->queryAll();
//            ))->text; //for debug: uncomment this and comment string above

        return $result;
//        echo $result['members'];die; //for debug: uncomment this and comment string above
    }

    /**
     * Compose conditions for further SQL request
     *
     * @param array $post
     * @return array
     */
    public function composeConditions(array $post){
        $condition = array('and');
        $condition[] = "`t1`.`id` = `t2`.`mid`";
        if(isset($post['id']) && $post['id'] != '') {
            $id = $post['id'];
            $condition[] = "`t1`.`id` = '$id'";
        }
        if(isset($post['name']) && $post['name'] != ''){
            $name = '%'.$post['name'].'%';
            $condition[] = "`t1`.`username` LIKE '$name'";
        }
        if(isset($post['membershipType']) && $post['membershipType'] != ''){
            $membershipType = $post['membershipType'];
            $condition[] = "`t2`.`payment_type` = '$membershipType'";
        }
        if(isset($post['expireDateFrom']) && $post['expireDateFrom'] != ''){
            $expireDateFrom = date('Y-m-d', strtotime($post['expireDateFrom']));
            $condition[] = "`t2`.`membership_expire_date` >= '$expireDateFrom'";
        }
        if(isset($post['expireDateTo']) && $post['expireDateTo'] != ''){
            $expireDateTo = date('Y-m-d', strtotime($post['expireDateTo']));
            $condition[] = "`t2`.`membership_expire_date` <= '$expireDateTo'";
        }

        return $condition;
    }

    /**
     * Count total number of users according to conditions
     *
     * @param $conditions
     * @return number of users
     */
    public function countUsers($conditions){
        $count = Yii::app()->db->createCommand(array(
            'select' => array('count(*) as num'),
            'from' => 'tbl_users t1, tbl_users_profiles t2',
            'where' => ($conditions),
        ))->queryAll();

        return $count[0]['num'];
    }

    private function getLimit($post){
        if(isset($post['limit'])){
            return $post['limit'];
        }
        return 10;
    }

    private function getPage($post){
        if (isset($post['page']) && !empty($post['page'])) {
            return $post['page'];
        }
        return 0;
    }

    private function getOffset($page, $limit){
        if ($page == 0) {
            $offset = 0;
        } else {
            $offset = ($page * $limit) - $limit;
        }
        return $offset;
    }
    
    
}