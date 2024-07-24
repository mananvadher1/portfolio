<?php

use yii\db\Migration;

/**
 * Class m240722_114941_init_rbac
 */
class m240722_114941_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $manageTestimonials = $auth->createPermission('manageTestimonials');
        $manageTestimonials->description = 'managee all Testimonials (Full Permission)';
        $auth->add($manageTestimonials);

        $manageProjects = $auth->createPermission('manageProjects');
        $manageProjects->description = 'managee all Projects (Full Permission)';
        $auth->add($manageProjects);

        $manageBlog = $auth->createPermission('manageBlog');
        $manageBlog->description = 'managee all Blog (Full Permission)';
        $auth->add($manageBlog);

        $viewProject = $auth->createPermission('viewProject');
        $viewProject->description = 'Project actionView';
        $auth->add($viewProject);

        $testimonialManager = $auth->createPermission('testimonialManager');
        $auth->add($testimonialManager);
        $auth->addChild($testimonialManager, $manageTestimonials);
        $auth->addChild($testimonialManager, $viewProject);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $testimonialManager);
        $auth->addChild($admin, $manageProjects);
        $auth->addChild($admin, $manageBlog);

        $auth->assign($admin,1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
