<div>
    <span class="d-sm-inline h6 {{ in_array(request()->route()->getName(),['profile', 'my-profile']) ? 'text-white' : '' }}" wire:click="logout">Sign Out</span>
</div>
