<?php

Class Msg extends Obj {

	function __construct($POD,$type,$object_definition) { 
		parent::__construct($POD,$type,$object_definition);

		$this->success = true;
		return $this;	
	}
	
	
	// targetUser()
	// returns the target user
	function targetUser() {
		return $this->POD->getPerson(array('id'=>$this->targetUserId));
	}

	// actor()
	// returns originator of message
	// otherwise known as from, author, actor
	function actor() {
		// if we have a fromId, this is a message
		// and in messages, userId is used in a differerent manner.
		// so we need to use the alternative ->from() method.
		
		if ($this->fromId) { 
			$u = $this->from();
			if (!$u) {
				$u = $this->POD->getPerson();
				$u->nick='DELETED';
				$u->permalink='#';
			}
			return $u;
		} else {
			$u = $this->author();
			if (!$u->success()) {
				$u = $this->POD->getPerson();
				$u->nick='DELETED';
				$u->permalink='#';
			}
			return $u;
		}
	}

	// chooseMessage()
	// returns the appropriate message
	// based on currentUser's relationship to the message.
	function chooseMessage($displayToUserId=null) {

		if (!$displayToUserId) { 
			if ($this->POD->isAuthenticated()) { 
				$displayToUserId= $this->POD->currentUser()->id;
			} else {
				$displayToUserId = 0;
			}
		}


		if ($this->TYPE == 'activity') { 
			if ($displayToUserId==$this->userId) { 
				$str = $this->get('userMessage');
			} else if ($displayToUserId==$this->targetUserId) { 
				$str = $this->get('targetMessage');
			} else { 
				$str = $this->get('message');
			}		
		} else {
			$str = $this->get('message');
		}
	
		return $str;
	
	}
	
	// formatMessage() 
	// picks the right version of the message based on who is looking at it
	// does token replacements
	// returns the formatted string
	function formatMessage($displayToUserId=null) { 
		
		
		$str = $this->chooseMessage($displayToUserId);

		$str = preg_replace_callback('/\{actor\.(.*?)\}/', function ($matches) {
			$actor = $this->actor();
			return ($actor && method_exists($actor, 'permalink')) ? $actor->permalink($matches[1], true) : '';
		}, $str);
		$str = preg_replace_callback('/@actor\.(\w+)\b/', function ($matches) {
			$actor = $this->actor();
			return $actor ? (string)$actor->get($matches[1]) : '';
		}, $str);
		
		if ($this->targetUserId) { 
			$targetUser = $this->POD->getPerson(array('id'=>$this->targetUserId));
			if (!$targetUser->success()) {
				$targetUser->nick = 'DELETED';
				$targetUser->permalink='#';
			}
			$str = preg_replace_callback('/\{targetUser\.(.*?)\}/', function ($matches) use ($targetUser) {
				return ($targetUser && method_exists($targetUser, 'permalink')) ? $targetUser->permalink($matches[1], true) : '';
			}, $str);
			$str = preg_replace_callback('/@targetUser\.(\w+)\b/', function ($matches) use ($targetUser) {
				return $targetUser ? (string)$targetUser->get($matches[1]) : '';
			}, $str);

		}

		if ($this->targetContentId) { 
			if ($this->targetContentType=='content') { 
				$targetContent = $this->POD->getContent(array('id'=>$this->targetContentId));
			} else if ($this->targetContentType=='comment') { 
				$targetContent = $this->POD->getComment(array('id'=>$this->targetContentId));				
			} else if ($this->targetContentType=='group') { 
				$targetContent = $this->POD->getGroup(array('id'=>$this->targetContentId));				
			} 
			
			$str = preg_replace_callback('/\{targetContent\.(.*?)\}/', function ($matches) use ($targetContent) {
				return ($targetContent && method_exists($targetContent, 'permalink')) ? $targetContent->permalink($matches[1], true) : '';
			}, $str);
			$str = preg_replace_callback('/@targetContent\.(\w+)\b/', function ($matches) use ($targetContent) {
				return $targetContent ? (string)$targetContent->get($matches[1]) : '';
			}, $str);

		}
		if ($this->resultContentId) {
			if ($this->resultContentType=='content') { 
				$resultContent = $this->POD->getContent(array('id'=>$this->resultContentId));
			} else if ($this->resultContentType=='comment') { 
				$resultContent = $this->POD->getComment(array('id'=>$this->resultContentId));				
			} 
			$str = preg_replace_callback('/\{resultContent\.(.*?)\}/', function ($matches) use ($resultContent) {
				return ($resultContent && method_exists($resultContent, 'permalink')) ? $resultContent->permalink($matches[1], true) : '';
			}, $str);
			$str = preg_replace_callback('/@resultContent\.(\w+)\b/', function ($matches) use ($resultContent) {
				return $resultContent ? (string)$resultContent->get($matches[1]) : '';
			}, $str);
		}
		

		return $str;

	}


	// markAsRead() 
	// marks the message as read
	function markAsRead() {
		if ($this->POD->isAuthenticated() && $this->POD->currentUser()->id == $this->targetUserId) { 
			$this->set('status','read');
			$this->save();
		}
	}
	
	

 	function delete() {
 	
 		$this->success = false;
		if ($this->get('id')) {
			if (!$this->POD->isAuthenticated()) { 
				$this->throwError("Access denied");
				$this->error_code = 501;
				return null;
			}
			if (!$this->get('userId') == $this->POD->currentUser()->get('id')) { 
				$this->throwError("Access denied");
				$this->error_code = 501;
				return null;
			}
			
			$sql = "DELETE FROM {$this->table_name} WHERE id=" . $this->get('id');
			$this->POD->tolog($sql,2);
			$res = mysql_query($sql);
			$this->success = true;
			$this->DATA = array();
			return $this;
 		} else {
			// hasn't been saved yet
			$this->throwError("No such message");
			$this->error_code = 404;
			return null;
		}	
 	
 	
 	}
	
}	
