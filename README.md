# 公司项目管理系统（Laravel 12）

该项目是一个基于 Laravel 12 结构设计的公司项目管理系统，覆盖项目流程管理、时间节点、角色分工与腾讯文档测试模板自动复制。

## 功能范围

- 项目流程阶段：
  - 立项（initiation）
  - 设计（design）
  - 前端开发（frontend_development）
  - 后端开发（backend_development）
  - 测试（testing）
  - 上线（launch）
- 时间管理：
  - 设计完成时间（`design_due_at`）
  - 前端完成时间（`frontend_due_at`）
  - 后端完成时间（`backend_due_at`）
- 状态管理：
  - 设计状态（`design_status`）
  - 前端状态（`frontend_status`）
  - 后端状态（`backend_status`）
  - 综合状态（`overall_status`）
- 人员角色：
  - 项目经理（`project_manager_id`）
  - 设计师（`designer_id`）
  - 前端开发（`frontend_developer_id`）
  - 后端开发（`backend_developer_id`）
- 腾讯文档集成：
  - 立项时根据指定模板 `tencent_template_id` 自动复制测试模板，落库复制后的文档ID与URL。

## API

- `GET /api/projects`：项目列表（需 Sanctum 登录）
- `POST /api/projects`：创建项目并触发腾讯文档模板复制（需 Sanctum 登录）

## 腾讯文档配置

在 `.env` 中增加以下配置：

```env
TENCENT_DOCS_BASE_URL=https://docs.qq.com
TENCENT_DOCS_TOKEN=your_openapi_token
TENCENT_DOCS_TARGET_FOLDER_ID=your_folder_id
```

## 说明

当前环境无法直接下载 Laravel 官方脚手架依赖（网络受限），本仓库已按 Laravel 12 目录与编码习惯搭建了核心业务代码，可在具备网络环境后执行：

```bash
composer install
php artisan migrate
```

