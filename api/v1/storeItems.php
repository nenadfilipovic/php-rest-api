<?php
// Connect to database
include("../dbConnect.php");
$db = new dbConnect();
$connection = $db->getConnstring();
$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method)
	{
		case 'GET':
			// Retrive item
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				get_item($id);
			}
			else
			{
				get_items();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
            break;
        case 'POST':
            // Insert item
            insert_item();
            break;
        case 'PUT':
            // Update item
            $id=intval($_GET["id"]);
            update_item($id);
            break;
        case 'DELETE':
            // Delete item
            $id=intval($_GET["id"]);
            delete_item($id);
            break;
	}
// List all items
function get_items()
	{
		global $connection;
		$query="SELECT * FROM store";
		$response=array();
		$result=mysqli_query($connection, $query);
		while($row=mysqli_fetch_assoc($result))
		{
			$response[]=$row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
// List only selected item
function get_item($id=0)
    {
	    global $connection;
	    $query="SELECT * FROM store";
	    if($id != 0)
	    {
		    $query.=" WHERE id=".$id." LIMIT 1";
	    }
	    $response=array();
	    $result=mysqli_query($connection, $query);
	    while($row=mysqli_fetch_assoc($result))
	    {
            $response[]=$row;
	    }
	    header('Content-Type: application/json');
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}
// Add item to API
function insert_item()
	{
		global $connection;
		$insert_data = json_decode(file_get_contents('php://input'), true);
		$item_sku=$insert_data["item_sku"];
		$item_name=$insert_data["item_name"];
        $item_price=$insert_data["item_price"];
		$item_quantity=$insert_data["item_quantity"];
		if((!empty($item_sku) && is_numeric($item_sku) == TRUE) && (!empty($item_name)) && (!empty($item_price) && is_numeric($item_price) == TRUE) && (!empty($item_quantity) && is_numeric($item_quantity) == TRUE))
		{
			$query="INSERT INTO store SET item_sku='".$item_sku."', item_name='".$item_name."', item_price='".$item_price."', item_quantity='".$item_quantity."'";
		}
        if(mysqli_query($connection, $query))
        {
            $response=array(
                'status' => 201,
                'status_message' =>'Item Created Successfully.'
                );
            }
            else
            {
                $response=array(
                    'status' => 400,
                    'status_message' =>'Item Creation Failed.'
                    );
            }
		header('Content-Type: application/json');
		echo json_encode($response);
	}
// Update item in API
function update_item($id)
	{
		global $connection;
		$update_data = json_decode(file_get_contents("php://input"),true);
		$item_sku=$update_data["item_sku"];
		$item_name=$update_data["item_name"];
        $item_price=$update_data["item_price"];
		$item_quantity=$update_data["item_quantity"];
		if((!empty($id) && ($id != 0) && is_numeric($id) == TRUE) && (!empty($item_sku) && is_numeric($item_sku) == TRUE) && (!empty($item_name)) && (!empty($item_price) && is_numeric($item_price) == TRUE) && (!empty($item_quantity) && is_numeric($item_quantity) == TRUE))
		{
			$query="UPDATE store SET item_sku='".$item_sku."', item_name='".$item_name."', item_price='".$item_price."', item_quantity='".$item_quantity."' WHERE id=".$id;
		}
		if(mysqli_query($connection, $query))
		{
		    $response=array(
                'status' => 200,
                'status_message' =>'Item Updated Successfully.'
                );
            }
            else
            {
                $response=array(
                    'status' => 400,
                    'status_message' =>'Item Updation Failed.'
                    );
            }
		header('Content-Type: application/json');
		echo json_encode($response);
	}
// Delete item from API
function delete_item($id)
    {
	    global $connection;
	    $query="DELETE FROM store WHERE id=".$id;
	    if(mysqli_query($connection, $query))
	    {
		    $response=array(
                'status' => 200,
                'status_message' =>'Item Deleted Successfully.'
                );
            }
            else
            {
                $response=array(
                    'status' => 400,
                    'status_message' =>'Item Deletion Failed.'
                    );
            }
	    header('Content-Type: application/json');
        echo json_encode($response);
    }
?>