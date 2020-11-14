<?php 

namespace BeeJee\Models;

use BeeJee\Core\Model;

class Data extends Model
{
	private $db;

	const LIMIT = 3;


		public static function showTasks($data)
	{

	try{
			
			$db = static::getInstance();

			$page_num = (isset($data['page'])) ? $data['page'] : 1;
			$sort = (isset($data['sort'])) ? $data['sort'] : 'id';

			$query = "SELECT id, login, email, task_name, verified, edited FROM data"; 

			if ($sort){
				$query .= " ORDER BY ".$sort." DESC ";
			}

			if ($page_num >= 1){
				$num = ($page_num - 1) * self::LIMIT;
				$query .= " LIMIT ".$num.", ".self::LIMIT;
			}

			$stmt = $db->query($query);

			$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

			return $results;
		} catch (\PDOException $e){
			echo $e->getMessage();
		}
	}

		public static function addData($data)
	{
	try{

			$db = static::getInstance();

			$sql = 'INSERT INTO data (login, email, task_name) VALUES (:login, :email, :task_name)';

			$db->prepare($sql)->execute($data);


		} catch (PDOException $e){
			echo $e->getMessage();
		}	
	}

		public static function updateData($data)
			{
	try{

			$db = static::getInstance();

			if (static::verifyText($data['task_name'], $data['id']) === true) {
				$sql = "UPDATE data SET login=:login, email=:email, task_name=:task_name, verified=:verified, edited=:edited WHERE id=:id";
				$data += ['edited' => 1];
			} else
				{
				$sql = "UPDATE data SET login=:login, email=:email, task_name=:task_name, verified=:verified WHERE id=:id";
				}
				$db->prepare($sql)->execute($data);
		} catch (PDOException $e){
			echo $e->getMessage();
		}	
			}

		public static function getCount()
		{
			$db = static::getInstance();
			
			$sql = 'SELECT count(id) AS count FROM data';
			$res = $db->prepare($sql);
			$res->execute();
			$row = $res->fetch();

			return $row['count'];
		} 	

		private static function verifyText($text, $id){
			
			$db = static::getInstance();

			$query = 'SELECT task_name FROM data WHERE id ='.$id;

			$stmt = $db->query($query);

			$res = $stmt->fetch(\PDO::FETCH_ASSOC);

			return $result = ($text !== $res['task_name']) ? true : false;
		}

}