<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/firestore/v1/query_profile.proto

namespace GPBMetadata\Google\Firestore\V1;

class QueryProfile
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\FieldBehavior::initOnce();
        \GPBMetadata\Google\Protobuf\Duration::initOnce();
        \GPBMetadata\Google\Protobuf\Struct::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
\'google/firestore/v1/query_profile.protogoogle.firestore.v1google/protobuf/duration.protogoogle/protobuf/struct.proto"&
ExplainOptions
analyze (B�A"�
ExplainMetrics6
plan_summary (2 .google.firestore.v1.PlanSummary<
execution_stats (2#.google.firestore.v1.ExecutionStats"<
PlanSummary-
indexes_used (2.google.protobuf.Struct"�
ExecutionStats
results_returned (5
execution_duration (2.google.protobuf.Duration
read_operations (,
debug_stats (2.google.protobuf.StructB�
com.google.firestore.v1BQueryProfileProtoPZ;cloud.google.com/go/firestore/apiv1/firestorepb;firestorepb�GCFS�Google.Cloud.Firestore.V1�Google\\Cloud\\Firestore\\V1�Google::Cloud::Firestore::V1bproto3'
        , true);

        static::$is_initialized = true;
    }
}

