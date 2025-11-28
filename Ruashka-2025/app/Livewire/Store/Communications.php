<?php

namespace App\Livewire\Store;

use App\Models\StoreNotice;
use App\Models\StoreInternalMessage;
use App\Models\StorePersonnel;
use Livewire\Component;
use Livewire\WithPagination;

class Communications extends Component
{
    use WithPagination;

    public $activeTab = 'notices';
    public $search = '';
    public $showModal = false;
    public $modalType = '';

    public $notice_title;
    public $notice_content;
    public $notice_priority = 'normal';
    public $notice_expires_at;

    public $message_recipient_id;
    public $message_content;

    public function render()
    {
        $notices = [];
        $inbox = [];
        $sent = [];

        if ($this->activeTab === 'notices') {
            $notices = StoreNotice::query()
                ->where('store_id', 1)
                ->where('title', 'like', '%' . $this->search . '%')
                ->with('author')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } elseif ($this->activeTab === 'inbox') {
            $inbox = StoreInternalMessage::query()
                ->where('store_id', 1)
                ->where('recipient_id', 1)
                ->with('sender')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } elseif ($this->activeTab === 'sent') {
            $currentPersonnelId = StorePersonnel::where('store_id', 1)->first()?->id;

            $sent = StoreInternalMessage::query()
                ->where('store_id', 1)
                ->when($currentPersonnelId, function($query) use ($currentPersonnelId) {
                    return $query->where('sender_id', $currentPersonnelId);
                })
                ->with('recipient')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('livewire.store.communications', [
            'notices' => $notices,
            'inbox' => $inbox,
            'sent' => $sent,
            'personnel' => StorePersonnel::where('store_id', 1)->get(),
        ]);
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function openModal($type)
    {
        $this->modalType = $type;
        $this->showModal = true;
        $this->resetInputFields();
    }

    public function storeNotice()
    {
        $this->validate([
            'notice_title' => 'required|string|max:255',
            'notice_content' => 'required|string',
            'notice_priority' => 'required|string',
            'notice_expires_at' => 'nullable|date',
        ]);

        $firstPersonnel = StorePersonnel::where('store_id', 1)->first();

        StoreNotice::create([
            'store_id' => 1,
            'title' => $this->notice_title,
            'content' => $this->notice_content,
            'priority' => $this->notice_priority,
            'created_by' => $firstPersonnel ? $firstPersonnel->id : null,
            'expires_at' => $this->notice_expires_at,
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function storeMessage()
    {
        $this->validate([
            'message_recipient_id' => 'required|exists:store_personnel,id',
            'message_content' => 'required|string',
        ]);

        $firstPersonnel = StorePersonnel::where('store_id', 1)->first();

        StoreInternalMessage::create([
            'store_id' => 1,
            'sender_id' => $firstPersonnel ? $firstPersonnel->id : null,
            'recipient_id' => $this->message_recipient_id,
            'message' => $this->message_content,
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public $noticeId;
    public $editMode = false;

    public function editNotice($id)
    {
        $notice = StoreNotice::findOrFail($id);
        $this->noticeId = $id;
        $this->notice_title = $notice->title;
        $this->notice_content = $notice->content;
        $this->notice_priority = $notice->priority;
        $this->notice_expires_at = $notice->expires_at ? $notice->expires_at->format('Y-m-d') : null;

        $this->modalType = 'notice_edit';
        $this->showModal = true;
    }

    public function updateNotice()
    {
        $this->validate([
            'notice_title' => 'required|string|max:255',
            'notice_content' => 'required|string',
            'notice_priority' => 'required|string',
            'notice_expires_at' => 'nullable|date',
        ]);

        $notice = StoreNotice::findOrFail($this->noticeId);
        $notice->update([
            'title' => $this->notice_title,
            'content' => $this->notice_content,
            'priority' => $this->notice_priority,
            'expires_at' => $this->notice_expires_at,
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function deleteNotice($id)
    {
        StoreNotice::find($id)->delete();
    }

    public function deleteMessage($id)
    {
        StoreInternalMessage::find($id)->delete();
    }

    public $messageId;

    public function editMessage($id)
    {
        $message = StoreInternalMessage::findOrFail($id);
        $this->messageId = $id;
        $this->message_recipient_id = $message->recipient_id;
        $this->message_content = $message->message;

        $this->modalType = 'message_edit';
        $this->showModal = true;
    }

    public function updateMessage()
    {
        $this->validate([
            'message_recipient_id' => 'required|exists:store_personnel,id',
            'message_content' => 'required|string',
        ]);

        $message = StoreInternalMessage::findOrFail($this->messageId);
        $message->update([
            'recipient_id' => $this->message_recipient_id,
            'message' => $this->message_content,
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->notice_title = '';
        $this->notice_content = '';
        $this->notice_priority = 'normal';
        $this->notice_expires_at = '';
        $this->message_recipient_id = '';
        $this->message_content = '';
        $this->noticeId = null;
        $this->messageId = null;
    }
}
