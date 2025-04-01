<div class="carousel-item {{ $isActive ? 'active' : '' }} bg-light">
    <div class="text-center">
        <img src="{{ asset($image) }}" alt="{{ $category }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
    </div>
    <h3 class="text-center mt-4 {{ $categoryColor }}">{{ $category }}</h3>
    <ul class="list-group">
        @foreach ($workouts as $workout)
            <li class="list-group-item">
                <a href="#" class="text-decoration-none text-dark">
                    <strong>{{ $workout->title }}</strong><br>
                    {{ $workout->description }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
