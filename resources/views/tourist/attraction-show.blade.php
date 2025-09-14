<div id="comments-section" style="position: fixed; right: 0; top: 0; width: 350px; height: 100vh; background: #fff; box-shadow: -2px 0 8px rgba(0,0,0,0.1); overflow-y: auto; padding: 20px;">
    <button onclick="document.getElementById('comments-section').style.display='none'" class="btn-close">Cerrar ×</button>

    <h3>Comentarios</h3>

    <textarea id="comment-text" rows="4" placeholder="Escribe tu comentario..."></textarea>

    <select id="comment-rating">
        <option value="">Calificación</option>
        @for ($i=1; $i<=5; $i++)
            <option value="{{ $i }}">{{ $i }} estrella{{ $i > 1 ? 's' : '' }}</option>
        @endfor
    </select>

    <button onclick="submitComment()">Enviar comentario</button>

    <hr>

    <div id="comments-list">
        <!-- Aquí se mostrarán los comentarios -->
    </div>
</div>

<script>
    const attractionId = {{ $attraction->id }};
    const commentsList = document.getElementById('comments-list');

    function loadComments() {
        fetch(`/api/attractions/${attractionId}/comments`, {
            headers: {'Accept': 'application/json'}
        })
        .then(res => res.json())
        .then(data => {
            commentsList.innerHTML = '';
            if(data.length === 0) {
                commentsList.innerHTML = '<p>No hay comentarios aún.</p>';
                return;
            }
            data.forEach(comment => {
                const div = document.createElement('div');
                div.innerHTML = `
                    <p><strong>${comment.user.name}</strong> (${comment.rating} ⭐)</p>
                    <p>${comment.comment}</p>
                    <hr>
                `;
                commentsList.appendChild(div);
            });
        });
    }

    function submitComment() {
        const commentText = document.getElementById('comment-text').value;
        const commentRating = document.getElementById('comment-rating').value;

        fetch(`/api/attractions/${attractionId}/comment`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                comment: commentText,
                rating: commentRating
            })
        })
        .then(res => {
            if (!res.ok) throw new Error('Error al enviar');
            return res.json();
        })
        .then(data => {
            alert('Comentario enviado');
            document.getElementById('comment-text').value = '';
            document.getElementById('comment-rating').value = '';
            loadComments();
        })
        .catch(() => alert('Error al enviar'));
    }

    // Carga inicial de comentarios
    loadComments();
</script>
