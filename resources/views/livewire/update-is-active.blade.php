<div>
    <div class="custom-control custom-switch">
        <input
            wire:model="isActive"
            @if($user->is_active === 1) checked @endif
            type="checkbox"
            class="custom-control-input"
            id="{{ $user->id }}"
        />

        <label class="custom-control-label" for="{{ $user->id }}"></label>
    </div>
</div>
