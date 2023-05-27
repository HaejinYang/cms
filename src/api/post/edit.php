<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/util/response.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/PostStore.php';

$response_msg = "";
$is_success = false;

do {
    if (!isset($_POST['check_box_array'])) {
        $response_msg = "게시글을 선택해주세요";

        break;
    }

    if (!isset($_POST['bulk_option']) || $_POST['bulk_option'] === 'not_selected') {
        $response_msg = "선택 옵션을 확인해주세요.";

        break;
    }

    $post_store = new PostStore();
    foreach ($_POST['check_box_array'] as $id) {
        $option = $_POST['bulk_option'];
        switch ($option) {
            case "published":
                $post_store->updateStatus($id, 'published');
                break;
            case "draft":
                $post_store->updateStatus($id, 'draft');
                break;
            case "delete":
                $post_store->delete($id);
                break;
            default:
                break;
        }
    }

    $is_success = true;
} while (false);

if ($is_success) {
    header("Location: /admin/page/post/index.php");
} else {
    echo goBackWithResponse($response_msg);
}