<?php

namespace Controller;

require_once('Model/Post/PostsManager.php');
require_once('Model/Replies/RepliesManager.php');
require('Controller/CommentController.php'); 


use Controller\AdminController;
use Controller\CommentController;
use Controller\ThemaController;
use Model\Auth\AdminManager;
use Model\Comment\CommentManager;
use Model\Post\PostsManager;
use Model\Replies\RepliesManager; 


class PostsController 
{

	/**
	* show homepage
	**/
	public function accueil() {

		$posts = new PostsManager; 


		$messageTotal = 6;											// paginate posts 

		$total = $posts->countTotalPosts();

		$total = $total[0];


		$nbdePages = ceil($total / $messageTotal);

		if(isset($_GET['paginate'])){

			$pageActuelle = intval($_GET['paginate']);

			if($pageActuelle > $nbdePages){

				$pageActuelle = $nbdePages;
			}

		} else {

			$pageActuelle = 1;
		}

		$premiereEntree = ($pageActuelle - 1) * $messageTotal;


		$messages = $posts->postPaginate($premiereEntree, $messageTotal);	// show posts 

		$countThema = $posts->countThema();						 
		$ListTitles = $posts->showAll(' ASC');						// if no post have thema return only post title list
		$postWithoutThema = $posts->withoutThema();					// show thema without subtitles 

		$themas = new ThemaController;								// else show thema titles with subtitles
		$index = $themas->index();

		$codeList = new AdminManager;								// remove recover code we used 
		$dateList = $codeList->removeCodeAfter();

		require('view/Front/website/index.php');
	}

	/**
	*	Search area 
	**/
	public function search($keyword) {

		$keyword = htmlspecialchars($keyword);						// change keywords to search easily in bdd 
		$keyword = trim($keyword);
		$keyword = strip_tags($keyword);
		$keyword = strtolower($keyword);

		$search = new PostsManager; 
		$return = $search->searchWord($keyword);					// return research 

		require('view/Front/Posts/Search.php');
		
	}


	/**
	*	get index for "index" and "post" pages
	**/
	public function getIndex($id, $id_post) {

		$index = new PostsManager;
		$indexTitles = $index->showIndex($id);			// show index on update pages

		
		$countThema = $index->countThema();	


		$after = $index->lessThan($id);					//	show themas after the one we clicked 

		$id = $id + 1;

		$before = $index->moreThan($id);				//	show themas before the one we clicked		

		$posts = new PostsManager;

		if($id_post == null) {							// redirect to index page 
 
			$messages = $posts->show();

			$themas = new ThemaController;				// show thema with subtitles 
			$index = $themas->index();

			$postWithoutThema = $posts->withoutThema();	// show thema without subtitles

			require('view/Front/Posts/Asynchronious.php');

		}
		else {											// redirect to update page 

			$postExists = $posts->existPostPublished($id_post);

			if($postExists) { 

				$singleMessage = $posts->showPost($id_post);

				$postWithoutThema = $posts->withoutThema();	// show thema without subtitles 

				$comment = new CommentController;
				$showComment = $comment->showComment($id);

				require('view/Front/Posts/getIndex.php');

			}
			else {

				throw new \Exception('l\'article n\'existe pas');
			}
		}

	}

	/**
	* show one single post
	**/
	public function post($id) {

		if(isset($_SESSION['admin'])) {											// if admin is deleted during navigation 

			$AdminCreate = new AdminManager;
			$adminStillExists = $AdminCreate->existAdmin($_SESSION['id']);

			if($adminStillExists) { 

				$post = new PostsManager; 
				$postExists = $post->existPostPublished($id); 
				$countThema = $post->countThema();
				$postWithoutThema = $post->withoutThema();								// show themas and index 

				if($postExists) {

					$singleMessage = $post->showPost($id);

					$comment = new CommentController;									
					$showComment = $comment->showComment($id);							// get comment 

					$commentAdmin = new CommentManager;									// show "commentaire" title
					$nbComments = $commentAdmin->countCommentByPostAndModerate($id);

					$themas = new ThemaController;										// get index of articles  
					$index = $themas->index();

					require('view/Front/Posts/post.php');

				}
				else {

					throw new \Exception('l\'article n\'existe pas');
				}
			}
			else {

				header('Location: /projet_4/index.php?adminaction=logout');
			}
		}
		else {

			$post = new PostsManager; 
			$postExists = $post->existPostPublished($id); 
			$countThema = $post->countThema();
			$postWithoutThema = $post->withoutThema();	

			if($postExists) {

				$singleMessage = $post->showPost($id);

				$comment = new CommentController;
				$showComment = $comment->showComment($id);

				$commentAdmin = new CommentManager;									// show "commentaire" title
				$nbComments = $commentAdmin->countCommentByPostAndModerate($id);

				$themas = new ThemaController;
				$index = $themas->index();

				require('view/Front/Posts/post.php');

			}
			else {

				throw new \Exception('l\'article n\'existe pas');
			}
		}
	}

	/**
	* Show post admin 
	**/
	public function managePost() {

		$AdminCreate = new AdminManager;
		$adminStillExists = $AdminCreate->existAdmin($_SESSION['id']);

		if($adminStillExists) { 	

			$posts = new PostsManager; 

			$messageTotal = 10;															// paginate 

			$total = $posts->countTotalPosts();

			$total = $total[0];


			$nbdePages = ceil($total / $messageTotal);

			if(isset($_GET['paginate'])){

				$pageActuelle = intval($_GET['paginate']);

				if($pageActuelle > $nbdePages){

					$pageActuelle = $nbdePages;
				}

			} else {

				$pageActuelle = 1;
			}

			$premiereEntree = ($pageActuelle - 1) * $messageTotal;
			
			$managePosts = $posts->managePaginate($premiereEntree, $messageTotal, ' DESC');	// show posts 

			require('view/Back/Posts/managePost.php');

		}
		else {

			$admin = new AdminController;						// if admin does not exists, logout 							
			$admin->logout();
		}
	}

	/**
	* show page "create"
	**/
	public function create() {

		$AdminCreate = new AdminManager;
		$adminStillExists = $AdminCreate->existAdmin($_SESSION['id']); // if admin who creates post still exists in bdd

																	// if user is still registered as admin at the time he tries to create post
		if($adminStillExists) { 	

			$create = new PostsManager;

			$create->storePost();										// create new empty post 

			$newPost = $create->maxPostID(); 							// to redirect to new post

			header('Location: /projet_4/index.php?postaction=update&id=' . $newPost[0]);

		}
		else {

			$admin = new AdminController;							
			$admin->logout();
		}
	}

	/**
	*  show page "update" 
	**/
	public function update($id){

		$Admin = new AdminManager;
		$adminStillExists = $Admin->existAdmin($_SESSION['id']); // if admin who creates post still exists in bdd

		if($adminStillExists) {

			$updatePost = new PostsManager;

			$postExists = $updatePost->existPost($id); 

			if($postExists) { 									// if post exists 

				$themaShow = new ThemaController;
				$themas = $themaShow->showListThemas($id);

				$updateMessage = $updatePost->showPost($id);

				require('view/Back/Posts/update.php');
			}
			else {

				throw new \Exception('l\'article n\'existe pas');
			}
		}
		else {

			$admin = new AdminController;
			$admin->logout();
		}
	}

	/**
	* update one single admin
	**/
	public function updatePost($id, $title, $content){

		$AdminStore = new AdminManager;
		$adminStillExists = $AdminStore->existAdmin($_SESSION['id']); // if who creates post still exists in bdd

																	  // if user is still registered as admin at the time he tries to update post	
		if($adminStillExists) { 

			$update = new PostsManager; 

			$postExists = $update->existPost($id); 

			if($postExists) {											// if post exists 

				$updatePost = $update->updatePosts($id, $title, $content); 

				return true;
			}
			else {

				throw new \Exception('l\'article n\'existe pas');
			}
		}
		else {

			return false;
		}
	
	}

	/**
	*Show post if published, hide post if not 
	**/
	public function publish($id, $action) {

		$Admin = new AdminManager;
		$adminStillExists = $Admin->existAdmin($_SESSION['id']); // if admin who creates post still exists in bdd

		if($adminStillExists) {

			$postPublish = new PostsManager; 
			$postExists = $postPublish->existPost($id); 

			if($postExists) {

				if($action == 'true') {

					$postPublish->changePublish(1, $id);	

				}
				else if($action == 'false') {

					$postPublish->changePublish(0, $id);	

				}

				header('Location: /projet_4/index.php?postaction=update&id=' . $id);

			}
			else {

				throw new \Exception('l\'article n\'existe pas');
			}
		}
	}

	/**
	*	Post picture
	**/
	public function updatePicture($fichier, $id) {

		$Admin = new AdminManager;
		$adminStillExists = $Admin->existAdmin($_SESSION['id']); // if admin who creates post still exists in bdd

		if($adminStillExists) {

			$updatePicture = new PostsManager;
			$postExists = $updatePicture->existPost($id); 

			if($postExists) {
																						// verifier que url pas presente 
		        $unlink = $updatePicture->showPost($id);									// destroy last picture
		        $unlink_url = $unlink->getPicture_url();

		        if($unlink_url != NULL) {

		        	unlink($unlink_url);
		        }
		        
		        $url = 'public/uploads/' . basename(rand() . $fichier['name']);				// create data 
		        $alt = $fichier['name']; 

				$updatePicture->updatePostPicture($id, $url);								// update post table 

		        move_uploaded_file($fichier['tmp_name'], $url);								// move file 

		        return $url;

		        header('Location: /projet_4/index.php?postaction=update&id=' . $id);

		    }
			else {

				throw new \Exception('l\'article n\'existe pas');
			}

	    }
		else {

			return 'error';
		}	

	}

	/**
	*	delete picture
	**/

	public function deletePicture($id) {

		$Admin = new AdminManager;
		$adminStillExists = $Admin->existAdmin($_SESSION['id']); // if admin who creates post still exists in bdd

		if($adminStillExists) {

			$delete = new PostsManager;
			$postExists = $delete->existPost($id); 

			if($postExists) {

				$unlink = $delete->showPost($id);									// destroy last picture
		        $unlink_url = $unlink->getPicture_url();
		        
		        if($unlink_url != NULL) {

		        	unlink($unlink_url);
		        }

		        $delete->updatePostPicture($id, NULL);
		    }
			else {

				throw new \Exception('l\'article n\'existe pas');
			}

		}
		else {

			throw new \Exception('vous n\'etes plus admin');
		}
	}

	/**
	*  destroy post 
	**/
	public function destroy($id) {

		$Admin = new AdminManager;
		$adminStillExists = $Admin->existAdmin($_SESSION['id']); // if admin who creates post still exists in bdd

		if($adminStillExists) {

			$postDelete = new PostsManager; 
			$postExists = $postDelete->existPost($id); 

			if($postExists) {

				$unlink = $postDelete->showPost($id);									// destroy last picture
		        $unlink_url = $unlink->getPicture_url();

		        if($unlink_url != NULL) {

		        	unlink($unlink_url);
		        }

				$reply = new RepliesManager;					// delete associated replies 
				$reply->deleteReplyByPost($id);

				$deletedComment = new CommentManager; 			// delete all comments whom article has been deleted  
				$deletedComment->deletePostComment($id);

				$deleteMessage = $postDelete->delete($id);
			}
			else {

				throw new \Exception('l\'article n\'existe pas');
			}
		}
		else {

			$admin = new AdminController;
			$admin->logout();
		}
	}

}
