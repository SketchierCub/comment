<?php
function escape($html) {
	return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
// Intoarce un acelasi text cu careva caractere modificate ca sa fie intelese de hmtl
