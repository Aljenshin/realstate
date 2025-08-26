<div class="border-l-4 border-blue-200 pl-4 py-3">
    <!-- Comment Header -->
    <div class="flex items-center justify-between mb-2">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                <span class="text-blue-600 font-semibold text-sm">{{ substr($comment->user->name, 0, 1) }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-900">{{ $comment->user->name }}</span>
                <span class="text-sm text-gray-500 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
        </div>
        
        @auth
            @if($comment->user_id === Auth::id())
            <div class="flex space-x-2">
                <button onclick="editComment({{ $comment->id }})" class="text-gray-400 hover:text-blue-600 text-sm">
                    Edit
                </button>
                <button onclick="deleteComment({{ $comment->id }})" class="text-gray-400 hover:text-red-600 text-sm">
                    Delete
                </button>
            </div>
            @endif
        @endauth
    </div>

    <!-- Comment Content -->
    <div class="text-gray-700 mb-3" id="comment-content-{{ $comment->id }}">
        {{ $comment->content }}
    </div>

    <!-- Edit Form (Hidden by default) -->
    <div class="hidden mb-3" id="edit-form-{{ $comment->id }}">
        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                  rows="3" id="edit-textarea-{{ $comment->id }}">{{ $comment->content }}</textarea>
        <div class="flex space-x-2 mt-2">
            <button onclick="saveComment({{ $comment->id }})" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                Save
            </button>
            <button onclick="cancelEdit({{ $comment->id }})" class="bg-gray-600 text-white px-3 py-1 rounded text-sm hover:bg-gray-700">
                Cancel
            </button>
        </div>
    </div>

    <!-- Comment Actions -->
    <div class="flex items-center space-x-4 text-sm">
        @auth
        <button onclick="showReplyForm({{ $comment->id }})" class="text-blue-600 hover:text-blue-800 font-medium">
            💬 Reply
        </button>
        @endauth
        
        <span class="text-gray-500">{{ $comment->replies->count() }} replies</span>
    </div>

    <!-- Reply Form (Hidden by default) -->
    @auth
    <div class="hidden mt-3" id="reply-form-{{ $comment->id }}">
        <form class="space-y-2" onsubmit="submitReply(event, {{ $comment->id }})">
            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                      rows="2" placeholder="Write a reply..." required></textarea>
            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                    Reply
                </button>
                <button type="button" onclick="hideReplyForm({{ $comment->id }})" class="bg-gray-600 text-white px-3 py-1 rounded text-sm hover:bg-gray-700">
                    Cancel
                </button>
            </div>
        </form>
    </div>
    @endauth

    <!-- Replies -->
    @if($comment->replies->count() > 0)
    <div class="mt-3 ml-6 space-y-3">
        @foreach($comment->replies as $reply)
        <div class="border-l-2 border-gray-200 pl-3 py-2">
            <div class="flex items-center space-x-2 mb-1">
                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                    <span class="text-green-600 font-semibold text-xs">{{ substr($reply->user->name, 0, 1) }}</span>
                </div>
                <span class="font-semibold text-gray-900 text-sm">{{ $reply->user->name }}</span>
                <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
            </div>
            <div class="text-gray-700 text-sm">{{ $reply->content }}</div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<script>
function editComment(commentId) {
    document.getElementById(`comment-content-${commentId}`).classList.add('hidden');
    document.getElementById(`edit-form-${commentId}`).classList.remove('hidden');
}

function cancelEdit(commentId) {
    document.getElementById(`comment-content-${commentId}`).classList.remove('hidden');
    document.getElementById(`edit-form-${commentId}`).classList.add('hidden');
}

function saveComment(commentId) {
    const content = document.getElementById(`edit-textarea-${commentId}`).value;
    
    // This will be implemented with the comment update API
    console.log('Save comment:', commentId, content);
    
    // For now, just hide the form
    cancelEdit(commentId);
}

function deleteComment(commentId) {
    if (confirm('Are you sure you want to delete this comment?')) {
        // This will be implemented with the comment delete API
        console.log('Delete comment:', commentId);
    }
}

function showReplyForm(commentId) {
    document.getElementById(`reply-form-${commentId}`).classList.remove('hidden');
}

function hideReplyForm(commentId) {
    document.getElementById(`reply-form-${commentId}`).classList.add('hidden');
}

function submitReply(event, commentId) {
    event.preventDefault();
    const form = event.target;
    const content = form.querySelector('textarea').value;
    
    // This will be implemented with the reply API
    console.log('Submit reply:', commentId, content);
    
    // For now, just hide the form
    hideReplyForm(commentId);
    form.reset();
}
</script>
