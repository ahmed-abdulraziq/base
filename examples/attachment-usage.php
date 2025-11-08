<?php

/**
 * مثال على استخدام نظام حفظ الملفات والصور
 * Attachment System Usage Example
 */

// في Controller
class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // رفع صورة الملف الشخصي
        if ($request->hasFile('avatar')) {
            $user->upload_file($request->file('avatar'), 'avatar', 'image');
        }

        // رفع عدة صور للمعرض
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $user->upload_file($image, 'gallery', 'image');
            }
        }

        return response()->json(['message' => 'User created successfully']);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // تحديث صورة الملف الشخصي
        if ($request->hasFile('avatar')) {
            // حذف الصورة القديمة
            $oldAvatar = $user->getFirstAttachmentByName('avatar');
            if ($oldAvatar) {
                $user->deleteAttachment($oldAvatar);
            }
            
            // رفع الصورة الجديدة
            $user->upload_file($request->file('avatar'), 'avatar', 'image');
        }

        return response()->json(['message' => 'User updated successfully']);
    }
}

// في Model
class User extends Authenticatable
{
    use HasAttachment;

    // تحديد الحقول التي يمكن رفع ملفات لها
    protected $attachmentFields = ['avatar', 'gallery', 'documents'];

    // العلاقات
    public function avatar()
    {
        return $this->getFirstAttachmentByName('avatar');
    }

    public function gallery()
    {
        return $this->getAttachmentsByName('gallery');
    }

    public function documents()
    {
        return $this->getAttachmentsByName('documents');
    }
}

// في Blade Template
/*
@if($user->avatar)
    <img src="{{ $user->avatar->url }}" alt="User Avatar" class="avatar">
@else
    <div class="avatar-placeholder">No Avatar</div>
@endif

@foreach($user->gallery as $image)
    <img src="{{ $image->url }}" alt="Gallery Image" class="gallery-image">
@endforeach
*/

// في API Resource
class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar ? [
                'url' => $this->avatar->url,
                'size' => $this->avatar->human_size,
                'extension' => $this->avatar->extension,
            ] : null,
            'gallery' => $this->gallery->map(function ($image) {
                return [
                    'url' => $image->url,
                    'size' => $image->human_size,
                    'extension' => $image->extension,
                ];
            }),
        ];
    }
}

// الفرق بين attachmentable و owner:
/*
- attachmentable: الموديل الذي ينتمي إليه المرفق (مثل: Post, Product, User)
- owner: المستخدم الذي رفع المرفق (User, Admin, etc.)

مثال:
$post = Post::find(1);
$user = User::find(1);

// رفع صورة للمقال بواسطة المستخدم
$attachment = $post->upload_file($file, 'featured_image', 'image', $user->id);

// النتيجة:
// attachmentable_id = 1 (Post ID)
// attachmentable_type = 'App\Models\Post'
// owner_id = 1 (User ID) 
// owner_type = 'App\Models\User'
*/

// استخدامات إضافية
class Product extends BaseModel
{
    use HasAttachment;

    protected $attachmentFields = ['images', 'manual', 'certificate'];

    // رفع ملفات متعددة
    public function uploadMultipleFiles($files, $name, $type = 'image')
    {
        foreach ($files as $file) {
            $this->upload_file($file, $name, $type);
        }
    }

    // حذف جميع المرفقات
    public function delete()
    {
        $this->deleteAllAttachments();
        parent::delete();
    }
}

// في Request Validation
class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'manual' => 'file|mimes:pdf,doc,docx|max:10240',
            'certificate' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];
    }
}

// استخدام Scopes في Attachment
$images = Attachment::images()->get();
$documents = Attachment::ofType('document')->get();
$userAttachments = $user->attachments()->images()->get();

// التحقق من نوع الملف
if ($attachment->isImage()) {
    echo "This is an image file";
}

// الحصول على حجم الملف بصيغة مقروءة
echo $attachment->human_size; // "2.5 MB"

// الحصول على URL كامل للملف
echo $attachment->url; // "http://example.com/storage/2024/01/uuid.jpg"

// أمثلة على استخدام morphs للـ owner:
class Post extends BaseModel
{
    use HasAttachment;
    protected $attachmentFields = ['featured_image', 'gallery'];
}

// رفع صورة مقال بواسطة admin
$admin = Admin::find(1);
$post = Post::find(1);

// الطريقة الأولى: رفع بواسطة المستخدم الحالي (Admin)
Auth::login($admin);
$post->upload_file($file, 'featured_image', 'image');

// الطريقة الثانية: تحديد المستخدم يدوياً
$post->upload_file($file, 'featured_image', 'image', $admin->id);

// النتيجة في قاعدة البيانات:
// attachmentable_id = 1 (Post ID)
// attachmentable_type = 'App\Models\Post'
// owner_id = 1 (Admin ID)
// owner_type = 'App\Models\Admin'

// الحصول على المرفقات حسب المالك
$adminUploads = $admin->ownedAttachments()->get();
$userUploads = $user->ownedAttachments()->get();

// الحصول على مرفقات مقال معين
$postAttachments = $post->attachments()->get();

// البحث عن مرفقات رفعها admin معين
$adminPostAttachments = $post->attachments()
    ->where('owner_type', Admin::class)
    ->where('owner_id', $admin->id)
    ->get();
